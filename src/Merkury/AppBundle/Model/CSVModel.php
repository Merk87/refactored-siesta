<?php
/**
 * Created by Merkury (Víctor Moreno)
 */

namespace Merkury\AppBundle\Model;

use Exception;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class CSVModel
 * This class was designed in order to allow as interact with the CSV file using a OO style.
 * All the functions contained in this class are designed baring in mind the structure and specifications of the Gousto
 * CSV File.
 * @package AppBundle\Service
 */
abstract class CSVModel
{
    public static $sourceFile = 'gousto_data_source.csv';

    protected static $QUERY_BLACK_LIST_KEYS = ['created_at','updated_at','box_type','title','slug','short_title','marketing_description','calories_kcal','protein_grams','fat_grams','carbs_grams','bulletpoint1','bulletpoint2','bulletpoint3','recipe_diet_type_id','season','base','protein_source','preparation_time_minutes','shelf_life_days','equipment_needed','origin_country','in_your_box','gousto_reference'];

    /**
     * General select function, inspired in Doctrine ORM find() function
     * @param array $params
     * $params estructure should be ['key' => 'value']
     * @return array
     * @throws Exception
     */
    public static function select(array $params = null)
    {
        if(array_filter($params, function($i){ return in_array($i, self::$QUERY_BLACK_LIST_KEYS);})){
            throw new Exception('Invalid select parameter');
        }

        $data = self::getSourceData();
        if(empty($data) || !is_array($data)){
            throw new Exception('Empty dataset');
        }

        $result = array_filter($data, function($row) use ($params){
            return array_intersect_assoc($params, $row) == $params ?: null;
        });

        $models = [];
        foreach ($result as $r){
            $models[] = static::createFromArray($r);
        }

        return count($models) == 1 ? array_shift($models) : $models;
    }

    /**
     * General select function, inspired in Doctrine ORM find() function
     * @param array $params
     * $params estructure should be ['key' => 'value']
     * @return array
     * @throws Exception
     */
    public static function selectPaginated(array $params = null, $page = null, $limit = 1, $array = false)
    {
        if(array_filter($params, function($i){ return in_array($i, self::$QUERY_BLACK_LIST_KEYS);})){
            throw new Exception('Invalid select parameter');
        }

        $limit = $limit < 1 ? 1 : $limit;

        $data = self::getSourceData();
        if(empty($data) || !is_array($data)){
            throw new Exception('Empty dataset');
        }

        $result = array_filter($data, function($row) use ($params){
            return array_intersect_assoc($params, $row) == $params ? $row : null;
        });

        if($array){
            return self::paginate($result, $page, $limit);
        }

        $models = [];
        foreach($result as $row){
            $models[] = self::createFromArray($row);
        }

        return self::paginate($models, $page, $limit);
    }

    /**
     * Returns all the content on the CSV File as an orray of objects
     * $params estructure should be ['key' => 'value']
     * @return array
     */
    public static function selectAll()
    {
        return self::getSourceData();
    }

    /**
     * General persist function. The function is able to detect if is a new object or an update.
     * @return array|bool
     */
    public function persist()
    {
        $records = self::getSourceData();
        $sourceFile = self::getSourceData(true);

        $now = new \DateTime();
        $this->setUpdatedAt($now->format('d/m/Y H:i:s'));

        if(!isset($this->id) ){
            $newId = array_pop($records)['id'] + 1;
            $this->setId($newId);
            $dataStream = array_values(get_object_vars($this));
            $file = fopen($sourceFile->getRealPath(), 'a');
            $res = fputcsv($file, $dataStream);
            fclose($file);
            return $res != false ? $this->toArray() : null;

        }

        $records[$this->getId() - 1] = $this->toArray();
        $totalLines = count($records);
        $backupFileName = $sourceFile->getPath().'backup_'.$sourceFile->getFileName();
        copy($sourceFile->getRealPath(), $backupFileName);
        $temp = fopen($sourceFile->getPath().'temp.csv', "a");

        fputcsv($temp, $this->getDataHeaders());

        if(!$temp){
            return null;
        }
        $writted = 0;
        foreach ($records as $record) {
            $tres = fputcsv($temp, $record);
            if($tres > 0)
                $writted++;
        }


        rename($sourceFile->getPath().'temp.csv', $sourceFile->getRealPath());

        if($totalLines != $writted){
            rename($backupFileName, $sourceFile->getRealPath());
            return false;
        }

        if(file_exists($backupFileName)){
            unlink($backupFileName);
        }

        return $this->toArray();

    }

    /**
     * Function to create a valid Model previously to the persist action
     * @param array|null $params
     * @return CSVModel
     * @throws Exception
     */
    public function save(array $params = null, $new = true){
        $arrayRecipe = array_replace($this->toArray($new), $params);
        return $this->createFromArray($arrayRecipe, $new);
    }

    /**
     * Pagination function
     * @param $data
     * @param $page
     * @param $limit
     * @return array
     */
    private static function paginate($data, $page, $limit){
        $offset = ($page - 1) * $limit;

        return [
            'pages' => ceil(count($data) / $limit),
            'current_page' => $page,
            'next_page' => $page < count($data) / $limit  ? $page + 1 : null,
            'prev_page' => $page >= count($data) / $limit ? (($page - 1 > 0) ? $page - 1 : null) : null,
            'results' => array_slice($data, $offset, $limit ),
        ];

    }

    /**
     * Function to retrieve all the contents from the CSV file as an associative array
     * @param bool $getFile
     * @return array|mixed
     */
    private static function getSourceData($getFile = false)
    {
        $finder = new Finder();
        $finder->name(self::$sourceFile);

        $files = $finder->files()->in(__DIR__. '/../../../../web/sources/')->getIterator();

        $files->rewind();

        if ($files->current() == null) {
            throw new NotFoundResourceException("The data source file is missing. \nPlease add the CSV file to /web/sources/ and configure the file name parameter (source_file_name) in the parameters file.");
        }

        if($getFile){
            return $files->current();
        }

        $data_array = array_map('str_getcsv', file($files->current()->getRealPath()));

        array_walk($data_array, function (&$a) use ($data_array) {
            $a = array_combine($data_array[0], $a);
        });

        array_shift($data_array);

        return $data_array;
    }

    /**
     * Function to create CSV array result to an object
     * @param array $array
     * @return static()
     * @throws Exception
     */
    public static function createFromArray(array $array, $new = false)
    {
        $model = new static();
        $idColName = static::idColName();

        if (!isset($array[$idColName]) && !$new) {
            throw new Exception('Unable to create model from array with missing id in CreateFromArray()');
        }

        if(!$new){
            $id = $array[$idColName];
            unset($array[$idColName]);

            $model->setId($id);
        }

        $model->setFromArray($array, $new);
        return $model;
    }

    /**
     * Auxiliar function to hydratate the object
     * @param array $array
     * @throws Exception
     */
    private function setFromArray(array $array, $new = false)
    {
        $idColName = static::idColName();

        if (isset($array[$idColName]) && $new == false) {
            $this->setId($array[$idColName]);
        }

        if (empty($array)) {
            throw new Exception('Illegal empty array');
        }

        if($new == true){
            unset($array[$idColName]);
        }

        foreach($array as $key => $data){
            $propertySetter = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if(in_array($propertySetter, get_class_methods($this))){
                $this->{$propertySetter}($data);
            }
        }
    }

    /**
     * Function to retrieve object results as an array
     * @return array
     * @throws Exception
     */
    public function toArray($newObject = false)
    {
        if ($this->getId() == null && !$newObject) {
            throw new Exception('Unable to create array from model with missing id');
        }
        $dataHeaders = $this->getDataHeaders();
        $dataStream = [];

        foreach($this->getDataHeaders() as $key){
            $propertyGetter = 'get'.str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            $dataStream[] = $this->{$propertyGetter}();
        }
        return array_combine($dataHeaders, $dataStream);
    }

    /**
     * Function to set Entity Id with check
     * @param $id
     * @throws Exception
     */
    public function setId($id)
    {
        if (!is_numeric($id)) {
            throw new Exception('ID value is not numeric');
        }
        $this->id = $id;
    }

    /**
     * Function to return keyname for main identifier.
     * @return string
     */
    public static function idColName()
    {
        return 'id';
    }

    /**
     * Function to return field names in snake_case
     * @return array
     */
    public function getDataHeaders(){
        $dataHeaders = [];

        foreach(array_keys(get_object_vars($this)) as $key){
            $dataHeaders[] = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", $key));
        }
        return $dataHeaders;


    }

}
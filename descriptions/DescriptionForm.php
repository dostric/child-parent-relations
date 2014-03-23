<?php



class DescriptionFrom implements ControllerInterface {


    protected $subject;


    /**
     * @var DescriptionForm_Model
     */
    protected $model;


    /**
     * @var DescriptionItemController[]
     */
    protected $items;


    public function __construct($subject = null) {

        $this->items = array();

        $this->subject = $subject;

    }


    public static function make($subject = null) {
        return new static($subject);
    }


    /**
     * @return bool
     */
    public function isLoaded() {
        return $this->model instanceof DescriptionForm_Model && $this->model->id;
    }


    /**
     * @param null $key
     * @return DescriptionForm_Model|mixed
     */
    public function model($key = null) {
        return $key === null ? $this->model : $this->model->{$key};
    }


    /**
     * @return DescriptionForm_Model|null
     */
    public function getId() {
        return $this->isLoaded() ? $this->model('id') : null;
    }


    public function load($subject = null) {

        $refKey = null;

        if (is_object($subject)) $this->subject = $subject;

        if (is_object($this->subject)) {

            switch(get_class($this->subject)) {

                case 'Object':
                    //we are loading object form
                    break;
                case 'Unit':
                    //we are loading unit form
                    break;

            }

        }

        if ($refKey) {

            // load the form
            $this->model = new DescriptionForm_Model();


        }


    }



    public function items() {
        return $this->items ?: $this->items = DescriptionItemController::make($this)->load();
    }


}
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * Clase que almacena y genera los datos de sesión
     */
    class LogData
    {
        /**
         * variable data
         * Almacena el array de datos del usuario
         * @var array() 
         */
        private $data;

        /**
         * variable type
         * Almacena el tipo de usuario que accede
         * @var string
         */
        private $type;

        private $CI;
        /**
         * Constructor
         * 
         */
        public function __construct() {
            $CI =& get_instance();
        }

        /**
         * retrieveSession
         * Esta función sirve para verificar si ya tiene datos almacenados el array, en caso de
         * no tenerlos se revisa en los datos de sesión para recuperarlos
         * en caso de no existir regresa falso
         * @return boolean
         */
        public function retrieveSession()
        {   
            $this->CI =& get_instance();
            if(sizeof($this->data)==0)
            {
                if(isset($_SESSION['authData']))
                {
                    $this->data = $_SESSION['authData'];
                    $this->type = $_SESSION['authType'];
                    return true;
                }
                if(isset($_COOKIE['sessionKey']))
                {
                    var_dump($_COOKIE['sessionKey']);
                    $this->data = dbConnection::select(["*"], "usuarios", [["sessionKey", $_COOKIE['sessionKey']]]);
                    if(sizeof(dbConnection::select(["*"], "medicos", [["id_usuario", $this->data[0]['id_usuario']]]))>0)
                    {
                        $this->type = "medicos";
                    }
                    elseif(sizeof(dbConnection::select(["*"], "recepcionistas", [["id_usuario", $this->data[0]['id_usuario']]]))>0)
                    {
                        $this->type = "recepcionistas";
                    }
                    elseif(sizeof(dbConnection::select(["*"], "pacientes", [["id_usuario", $this->data[0]['id_usuario']]]))>0)
                    {
                        $this->type = "pacientes";
                    }
                    elseif(sizeof(dbConnection::select(["*"], "administradores", [["id_usuario", $this->data[0]['id_usuario']]]))>0)
                    {
                        $this->type = "administradores";
                    }
                    return true;
                }
            }
            else
            {
                return true;
            }
            return false;
        }

        /**
         * logIn function
         * Funcion para generar el logIn, en caso que se obtengan los datos correctamente se regresa un true señalando que fue correcto
         * En caso contrario regresa un false indicando que no se realizo el logIn correctamente
         * La contraseña que se recibe se hashea para ser comparada con la contraseña ya hasheada en la base de datos.
         * @param string $name usuario o correo para el inicio de sesión
         * @param string $pass contraseña para el inicio de sesión
         * @param boolean $stay Este campo lo que hace es que si se recibe en true almacenara en la base de datos una llave y 
         *          la guardara en una cookie para que si vuelve a acceder se obtengan los datos automaticamente a partir de esa cookie.
         * @return void
         */
        public function logIn($name, $pass, $stay = false)
        {
            $this->CI =& get_instance();
            $cipher_pass = hash("sha256", $pass);
            $obtainedData = $this->CI->db->query("SELECT * FROM users WHERE email = '$name' AND password = '$cipher_pass'");
            $this->data = $obtainedData->result_array(); 
            if(sizeof($this->data)!=0)
            {
                if(sizeof($this->CI->db->query("SELECT * FROM superusers WHERE id_usuario = ".$this->data[0]['id'])->result_array()))
                {
                    $this->type = "SU";
                    
                }
                elseif(sizeof($this->CI->db->query("SELECT * FROM mortals WHERE id_usuario = ".$this->data[0]['id'])->result_array()))
                {
                    $this->type = "mortal";
                }
                else
                {
                    $this->type = "";
                    $this->data = array();
                    return false;
                }
                if($stay)
                {
                    $tiempo = getdate();
                    $key = "";
                    foreach($tiempo as $v)
                    {
                        $key .= $v;
                    }
                    foreach($this->data[0] as $v)
                    {
                        $key .= $v;
                    }
                    $cipherKey = hash("sha256", $key);
                    $this->CI->db->query("UPDATE users SET remember_token = '$cipherKey' WHERE id = " . $this->data[0]['id']);
                    setcookie("sessionKey", $cipherKey, time()+3600*3600*10, "/");
                }
                $_SESSION['authData'] = $this->data;
                $_SESSION['authType'] = $this->type;
                return true;
            }
            else
            {
                return false;
            }
        }

        /**
         * getData
         * Este método obtiene el dato solicitado de los datos ya almacenados.
         * @param [type] $columna
         * @return string: Regresa el dato solicitado o en caso de no existir regresa un string con tal aclaración
         */
        public function getData($columna)
        {
            $this->CI =& get_instance();

                if( $this->retrieveSession() || sizeof($this->data[0])!=0)
                {
                    if(isset($this->data[0][$columna]))
                    {
                        return $this->data[0][$columna];   
                    }
                }
                    
            return null;
        }
        
        /**
         * logOut
         * Esta función realiza el logOut al eliminar todos los datos de usuario almacenados
         * @return void
         */
        public function logOut()
        {
            $this->CI =& get_instance();
            $this->retrieveSession();
            if(isset($this->data))
            {
                $this->CI->db->query("UPDATE users SET remember_token = '' WHERE id = " . $this->data[0]['id']);
                setcookie("sessionKey", "", time() - 3600);
                $this->data = array();
                $this->type = "";
                unset($_SESSION['authData']);
                unset($_SESSION['authType']);
                unset($_COOKIE['sessionKey']);
            }
        }

        public function getType()
        {
            $this->CI =& get_instance();
            if($this->retrieveSession())
            {
                if(isset($this->type))
                {
                    return $this->type;
                }
                else return null;
            }
        }

    }
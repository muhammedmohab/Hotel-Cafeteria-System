<?PHP

class QueryBuilder {
    
    protected $pdo ; 
    public function __construct( $pdo )
    {
        $this->pdo = $pdo ; 
    }

    public function selectALL ($table){

        $statement = $this->pdo->prepare("select * from $table");

        $statement->execute() ; 

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function add_user ($table,$username, $password, $image, $firstname, $lastname){

        $sql = "insert into $table (username,password,image,firstname,lastname) values (?,?,?,?,?)";
        $stmt= $this->pdo->prepare($sql);
         $stmt->execute([$username, $password, $image, $firstname, $lastname]);

    }

    public function edit_user ($table,$username, $password, $image, $firstname, $lastname , $id){

        $sql = "update $table set username= ? ,password= ? ,image= ? ,firstname= ? ,lastname= ? where id = ?";
        
        $stmt= $this->pdo->prepare($sql);

        $stmt->execute([$username, $password, $image, $firstname, $lastname , $id]);
    }


    public function delete_user($id){
        $sql = "delete from users where id = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$id]);

    }
}
?>
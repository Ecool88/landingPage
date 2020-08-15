<?php 
    require_once($_SERVER['DOCUMENT_ROOT'] . '/landing/functions/functions.php');
    checkUser('admin');
?>

<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . '/landing/config/config.php'); 

    // var_dump($_GET);

    if(!empty($_GET) && !empty($_GET['del'])){
            
        // $query = "UPDATE test SET REACTION='Позвонить клиенту' WHERE ID IN(" . implode(',', $_GET['del']) . ")";
        $query = "DELETE FROM test WHERE ID IN(" . implode(',', $_GET['del']) . ")";
        $res = mysqli_query($link, $query);
        if(!$res){
            // var_dump(mysqli_error($link));
            echo 'у вас нет записей';
        }
    }

    $query = "SELECT * FROM test;";
    $res = mysqli_query($link, $query);

    $feedbacks = [];
    while($row = mysqli_fetch_assoc($res)){
        $feedbacks[] = $row;
    }
    $heads = array_keys($feedbacks[0]);

    mysqli_close($link);



    if( isset( $_GET['logout'] ) )
    {    
        session_destroy();    
        header('Location: http://localhost/landing/admin/a_home.php');        
    }
?>


<form method="GET">
    <input type="submit" name="logout" value="Выход" />
</form>
<a href="/landing/admin/a_home.php"><button>Добавить новость</button></a>

<div class="feedbacks">
    <h1>Заявки</h1>
    <form method="get" action="">
        <table>
            <thead>
                <tr>
                    <?php foreach($heads as $head):?>
                        <th><?=$head?></th>
                    <?php endforeach;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($feedbacks as $id=>$row):?>
                    <tr>
                        <?php foreach($row as $key=>$cell):?>
                            <td>
                                <?php if($key === 'ID'):?>
                                    <input type="checkbox" value="<?=$cell?>" id="<?="row_$id"?>" name="del[]" readonly/>
                                <?php endif;?>
                                <label for="<?="row_$id"?>">
                                    <?=$cell?>
                                </label>
                            </td>
                        <?php endforeach;?>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <input type="submit" value="Удалить заявку"/>
    </form>
</div>



<script>
    for(let el of document.querySelectorAll('div.feedbacks table td label')){
    el.addEventListener('click', function() {
        this.parentElement.parentElement.classList.toggle('checked');
    });
}
</script>



<style>
    body{
    background-color: rgba(0,0,0,.06);
    }
    form:first-child{
        margin: 0;
        position: absolute;
        top: 10px;
        right: 10px;
    }
    form:first-child > input{
        cursor: pointer;
        height: 25px;
        background-color: #1e73be;
        color: white;
        border-radius: 3px;
        border: 1px solid #1e73be;
        font-size: 1.1rem;
    }
    body > a{
        margin: 0;
        position: absolute;
        top: 10px;
        right: 90px;
    }
    body > a > button{
        cursor: pointer;
        height: 25px;
        background-color: #1e73be;
        color: white;
        border-radius: 3px;
        border: 1px solid #1e73be;
        font-size: 1.1rem;
    }
    div.feedbacks {
  max-width: 1280px;
  margin: 2rem auto;
}

div.feedbacks table {
  border-collapse: collapse;
  width: 100%;
}

div.feedbacks table th, div.feedbacks table td {
  border: 1px solid black;
  text-align: center;
}

div.feedbacks table th {
  font-size: 1.3rem;
}

div.feedbacks table td input[type=checkbox] {
  display: none;
}

div.feedbacks table td label {
  padding: 10px 0;
  display: block;
}

div.feedbacks table tr.checked {
  background-color: rgba(228, 208, 29, 0.397);
}
div.feedbacks > form > input{
    margin-top: 1rem;
    cursor: pointer;
    height: 30px;
    background-color: red;
    color: white;
    border-radius: 5px;
    font-size: 1.1rem;
    color: white;
    border: 1px solid red;
}
</style>
<?php
class Task extends Model
{
    
    public function create($title, $description)
    {
    //    var_dump("YOYOOY");
    //    exit;
        $sql = "INSERT INTO tasks (title, description) VALUES (:title, :description)";
        
        $req = Database::getBdd()->prepare($sql);
        
        $req->execute([
            'title' => $title,
            'description' => $description

        ]);
        // var_dump($req);
         exit;
        //return $req;
    }

    public function showTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function showAllTasks()
    {
        $sql = "SELECT * FROM tasks";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function edit($id, $title, $description)
    {
        $sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>
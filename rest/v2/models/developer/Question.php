<?php
class Question
{
    public $question_aid;
    public $question_title;
    public $question_choices;
    public $question_is_active;
    public $question_datetime;
    public $question_created;

    public $connection;
    public $lastInsertedId;

    public $tblquestion;

    public $question_start;
    public $question_total;
    public $question_search;

    public function __construct($db)
    {
        $this->connection = $db;
        $this->tblquestion = "questions";
    }

    // create
    public function create()
    {
        try {
            $sql = "insert into {$this->tblquestion} ";
            $sql .= "( question_title, ";
            $sql .= "question_is_active, ";
            $sql .= "question_choices, ";

            $sql .= "question_datetime, ";
            $sql .= "question_created ) values ( ";
            $sql .= ":question_title, ";
            $sql .= ":question_is_active, ";
            $sql .= ":question_choices, ";

            $sql .= ":question_datetime, ";
            $sql .= ":question_created ) ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_title" => $this->question_title,
                "question_is_active" => $this->question_is_active,
                "question_choices" => $this->question_choices,
                "question_datetime" => $this->question_datetime,
                "question_created" => $this->question_created,
            ]);
            $this->lastInsertedId = $this->connection->lastInsertId();
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    // read all
    public function readAll()
    {
        try {
            $sql = "select * from {$this->tblquestion} ";
            $sql .= "order by question_is_active desc, ";
            $sql .= "question_title asc ";
            $query = $this->connection->query($sql);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    // read limit
    public function readLimit()
    {
        try {
            $sql = "select * from {$this->tblquestion} ";
            $sql .= "order by question_is_active desc, ";
            $sql .= "question_title asc ";
            $sql .= "limit :start, ";
            $sql .= ":total ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "start" => $this->question_start - 1,
                "total" => $this->question_total,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }


    public function search()
    {
        try {
            $sql = "select * from {$this->tblquestion} ";
            $sql .= "where question_title like :question_title ";
            $sql .= "order by question_is_active desc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_title" => "%{$this->question_search}%",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }


    // read by id
    public function readById()
    {
        try {
            $sql = "select * from {$this->tblquestion} ";
            $sql .= "where question_aid  = :question_aid ";
            $sql .= "order by question_is_active desc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_aid" => $this->question_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    // update
    public function update()
    {
        try {
            $sql = "update {$this->tblquestion} set ";
            $sql .= "question_title = :question_title, ";
            $sql .= "question_choices = :question_choices, ";
            $sql .= "question_datetime = :question_datetime ";
            $sql .= "where question_aid = :question_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_title" => $this->question_title,
                "question_choices" => $this->question_choices,
                "question_datetime" => $this->question_datetime,
                "question_aid" => $this->question_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    // active
    public function active()
    {
        try {
            $sql = "update {$this->tblquestion} set ";
            $sql .= "question_is_active = :question_is_active, ";
            $sql .= "question_datetime = :question_datetime ";
            $sql .= "where question_aid = :question_aid ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_is_active" => $this->question_is_active,
                "question_datetime" => $this->question_datetime,
                "question_aid" => $this->question_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    // delete
    public function delete()
    {
        try {
            $sql = "delete from {$this->tblquestion} ";
            $sql .= "where question_aid = :question_aid  ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_aid" => $this->question_aid,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    // name
    public function checkName()
    {
        try {
            $sql = "select question_title from {$this->tblquestion} ";
            $sql .= "where question_title = :question_title ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_title" => "{$this->question_title}",
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    // // name
    // public function checkAssociation()
    // {
    //     try {
    //         $sql = "select product_question_id from {$this->tblquestion} ";
    //         $sql .= "where product_question_id = :product_question_id ";
    //         $query = $this->connection->prepare($sql);
    //         $query->execute([
    //             "product_question_id" => $this->question_aid,
    //         ]);
    //     } catch (PDOException $ex) {
    //         $query = false;
    //     }
    //     return $query;
    // }


    public function filterByStatus()
    {
        try {
            $sql = "select * ";
            $sql .= "from {$this->tblquestion} ";
            $sql .= "where question_is_active = :question_is_active  ";
            $sql .= "order by question_is_active desc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_is_active" => $this->question_is_active,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }

    public function filterByStatusAndSearch()
    {
        try {
            $sql = "select * ";
            $sql .= "from {$this->tblquestion} ";
            $sql .= "where ";
            $sql .= "question_is_active = :question_is_active ";
            $sql .= "and question_title like :question_title ";
            $sql .= "order by question_is_active desc, ";
            $sql .= "question_title asc ";
            $query = $this->connection->prepare($sql);
            $query->execute([
                "question_title" => "%{$this->question_search}%",
                "question_is_active" => $this->question_is_active,
            ]);
        } catch (PDOException $ex) {
            $query = false;
        }
        return $query;
    }
}
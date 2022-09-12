<?php

use Illuminate\Database\Migrations\Migration;

class CreateVcompetencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createView());
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
        return <<<SQL
    CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vcompetence`  AS  
    (select distinct `c`.`libelle` AS `competences`,`d`.`libelle` AS `domaines`,`u`.`id` AS `user`,`u`.`statut_competence` AS `statut competence` from (((`freelanceyiki`.`profils` `p` join `freelanceyiki`.`competences` `c`) join `freelanceyiki`.`domaines` `d`) join `freelanceyiki`.`users` `u`) where `p`.`user_id` = `u`.`id` and `p`.`competence_id` = `c`.`id` and `p`.`domaine_id` = `d`.`id`);
SQL;
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {
        return <<<SQL
            DROP VIEW IF EXISTS `vcompetence`; 
SQL;
    }

}




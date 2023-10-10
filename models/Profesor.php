<?php

 class Profesor extends Conectar{

    public function buscar_profesor_x_dni($pro_dni){  
        $conectar= parent::conexion();   
        parent::set_names();
        $sql="select tm_profesor.pro_id, tm_tipo_documento.td_nom, tm_profesor.pro_dni, tm_profesor.pro_apep, tm_profesor.pro_apem,
            tm_profesor.pro_nom,concat(tm_region.reg_cod , tm_profesor.pro_dni) as 'nrocolegi', tm_region.reg_nom, tm_ugel.ug_nom,
            tm_profesor.pro_img,tm_profesor.sex_id
            from tm_profesor
            inner join tm_region on tm_profesor.reg_id = tm_region.reg_id
            inner join tm_ugel on tm_profesor.ug_id = tm_ugel.ug_id
            inner join tm_tipo_documento on tm_profesor.td_id = tm_tipo_documento.td_id
            inner join tm_sexo on tm_profesor.sex_id = tm_sexo.sex_id
            where 
            tm_profesor.est='1' and
            tm_profesor.pro_dni=?";
        $sql = $conectar->prepare($sql);
        $sql->bindvalue(1,$pro_dni);
        $sql->execute();
        return $resultado = $sql->fetchall(pdo::FETCH_ASSOC); 
    }

}
?>
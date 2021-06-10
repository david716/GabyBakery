function blonda() {
    var forma = $('#opt_forma_base').val();
    var color = $('#opt_color_base').val();
    var x = 0;
    var z = 0;
    if(forma == '1'){
        if($('#opt_forma').val() == '1'){
            x = 2.5; z = 3.5;
        }else{
            x = 3.5; z = 3.5;
        }
        BABYLON.SceneLoader.ImportMeshAsync("blonda_c", "../modelos/blonda/", "blonda.babylon").then((result) => {
            result.meshes[0].material = color_b(color);
            result.meshes[0].scaling.x = x; 
            result.meshes[0].scaling.z = z;  
        }); 
    }else{
        if($('#opt_forma').val() == '1'){
            x = 3.5; z = 3.5;
        }else{
            x = 3.9; z = 3.9;
        }
        BABYLON.SceneLoader.ImportMeshAsync("blonda_r", "../modelos/blonda/", "blonda.babylon").then((result) => {
            result.meshes[0].material =  color_b(color);
            result.meshes[0].scaling.x = x; 
            result.meshes[0].scaling.z = z;  
        }); 
    }
}

function mensaje (mensaje, pos_y){
    var color = $('#mensaje_color').val();
    var x = 0;
    var z = 0;
    if($('#men_pred').val()*1 != 0){
        if($('#opt_forma').val() == '1'){
            x = 0.6; z = 0.6;
        }else{
            x = 0.7; z = 1;
        }
        if($('#men_pred').val()*1 != 0){
            BABYLON.SceneLoader.ImportMeshAsync(mensaje, "../modelos/mensajes/", "mensaje.babylon").then((result) => {
                result.meshes[0].position.y = pos_y;
                result.meshes[0].material =  color_b(color);
                result.meshes[0].scaling.x = x; 
                result.meshes[0].scaling.z = z;
            }); 
        }
    }
}

function cuadrado_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde){
    var sabor_borde = $('#borde_sabor').val();
    BABYLON.SceneLoader.ImportMeshAsync(["cubierta","masa1","masa2","masa3","masa4","relleno1","relleno2","relleno3",borde], "../modelos/formas/Con_bordes/", "forma_cuadrada_1_libra.babylon").then((result) => {
        result.meshes[0].material =  color_cubierta(sabor_c);
        result.meshes[1].material =  color_masa(sabor_m_1_2);
        result.meshes[6].material =  color_masa(sabor_m_1_2);
        result.meshes[2].material =  color_masa(sabor_m_3_4);
        result.meshes[3].material =  color_masa(sabor_m_3_4);
        result.meshes[4].material =  color_filler(sabor_r);
        result.meshes[5].material =  color_filler(sabor_r);
        result.meshes[7].material =  color_filler(sabor_r);  
        result.meshes[8].material =  color_cubierta(sabor_borde);      
    }); 
}

function cuadrado_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde){
    var sabor_borde = $('#borde_sabor').val();
    BABYLON.SceneLoader.ImportMeshAsync(["cubierta","masa1","masa2","masa3","relleno1","relleno2",borde], "../modelos/formas/Con_bordes/", "forma_cuadrado_m_libra.babylon").then((result) => {
        result.meshes[0].material =  color_cubierta(sabor_c);
        result.meshes[1].material =  color_masa(sabor_m);
        result.meshes[3].material =  color_masa(sabor_m);
        result.meshes[4].material =  color_masa(sabor_m);
        result.meshes[2].material =  color_filler(sabor_r1);
        result.meshes[5].material =  color_filler(sabor_r2);
        result.meshes[6].material =  color_cubierta(sabor_borde);      
    }); 
}

function redondo_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde) {
    var sabor_borde = $('#borde_sabor').val();
    BABYLON.SceneLoader.ImportMeshAsync(["cubierta","masa1","masa2","masa3","masa4","relleno1","relleno2","relleno3",borde], "../modelos/formas/Con_bordes/", "forma_rendondo_1_libra.babylon").then((result) => {
        result.meshes[0].material =  color_cubierta(sabor_c);
        result.meshes[1].material =  color_masa(sabor_m_1_2);
        result.meshes[5].material =  color_masa(sabor_m_1_2);
        result.meshes[2].material =  color_masa(sabor_m_3_4);
        result.meshes[4].material =  color_masa(sabor_m_3_4);
        result.meshes[3].material =  color_filler(sabor_r);
        result.meshes[7].material =  color_filler(sabor_r);
        result.meshes[6].material =  color_filler(sabor_r);  
        result.meshes[8].material =  color_cubierta(sabor_borde);      
    });
}

function redondo_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde) {
    var sabor_borde = $('#borde_sabor').val();
    BABYLON.SceneLoader.ImportMeshAsync(["cubierta","masa1","masa2","masa3","relleno1","relleno2",borde], "../modelos/formas/Con_bordes/", "forma_redondo_m_libra.babylon").then((result) => {
        result.meshes[0].material =  color_cubierta(sabor_c);
        result.meshes[1].material =  color_masa(sabor_m);
        result.meshes[2].material =  color_masa(sabor_m);
        result.meshes[3].material =  color_masa(sabor_m);
        result.meshes[4].material =  color_filler(sabor_r1);
        result.meshes[5].material =  color_filler(sabor_r2);
        result.meshes[6].material =  color_cubierta(sabor_borde);      
    });
}

function numero(num, pos_y){
    tam = 0.07;
    var color = $('#velas_color').val();
    if(num.length == 1){
        BABYLON.SceneLoader.ImportMeshAsync("num_"+num, "../modelos/numeros/", "numeros2.babylon").then((result) => {
            result.meshes[0].scaling.x = tam;
            result.meshes[0].scaling.y = tam;
            result.meshes[0].scaling.z = tam;
            result.meshes[0].position.y = pos_y;
            result.meshes[0].material = color_b(color);
        });
    }else if(num.length == 2){
        var arr_num = num.split('');
    
        BABYLON.SceneLoader.ImportMeshAsync("num_"+arr_num[0], "../modelos/numeros/", "numeros2.babylon").then((result) => {
            result.meshes[0].scaling.x = tam;
            result.meshes[0].scaling.y = tam;
            result.meshes[0].scaling.z = tam;
            result.meshes[0].position.y = pos_y;
            result.meshes[0].position.z = -0.25;
            result.meshes[0].material = color_b(color);
        });
       
        BABYLON.SceneLoader.ImportMeshAsync("num_"+arr_num[1], "../modelos/numeros/", "numeros2.babylon").then((result) => {
            result.meshes[0].scaling.x = tam;
            result.meshes[0].scaling.y = tam;
            result.meshes[0].scaling.z = tam;
            result.meshes[0].position.y = pos_y;
            result.meshes[0].position.z = 0.25;
            result.meshes[0].material = color_b(color);
        });
    }
}

$(window).resize(function(){   
    var canvas = $('#renderCanvas');
    canvas.attr("height", "1000");
});

$('#opt_forma, #opt_color_base, #opt_forma_base, #tamano, #borde, #numero, #borde_sabor, #velas_color, #men_pred, #mensaje_color').change(function () {
    const createScene = function() {
        const scene = new BABYLON.Scene(engine);
        
        const camera = new BABYLON.ArcRotateCamera("Camera", 0, 0, 10, new BABYLON.Vector3(0,0,0), scene);
        camera.lowerRadiusLimit = 10;
        camera.upperRadiusLimit = 30;
        
        camera.useBouncingBehavior = true;
        camera.setPosition(new BABYLON.Vector3(16, 8, -15));
        camera.attachControl(canvas, true);
        
        new BABYLON.HemisphericLight('light', new BABYLON.Vector3(0, 1, 0), scene);
       
        sabor_cambio();
        var borde = '', pos_y;
        if($('#opt_forma').val() == '1'){
            switch ($('#borde').val()*1) {
                case 0:
                    borde = 'sin_borde';
                break;
                case 1:
                    borde = 'estrella_c';
                break;
                case 2:
                    borde = 'borde2_c';
                break;
            }
        }else{
            switch ($('#borde').val()*1) {
                case 0:
                    borde = 'sin_borde';
                break;
                case 1:
                    borde = 'estrella_r';
                break;
                case 2:
                    borde = 'borde2_r';
                break;
            }
        }

        switch ($('#opt_forma').val()) {
            case '1':
                if($('#tamano').val() == '1'){
                    pos_y = 2.6;
                    cuadrado_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                }else if($('#tamano').val() != '1'){
                    pos_y = 2;
                    cuadrado_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                }
            break;
            case '2':
                if($('#tamano').val() == '1'){
                    pos_y = 3.4;
                    redondo_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                }else if($('#tamano').val() != '1'){
                    pos_y = 3;
                    redondo_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                }
            break
        }

        numero($('#numero').val(), pos_y);
        mensaje($('#men_pred').val(), pos_y);

        $('.cubierta').click(function () { 
            sabor_c = $(this).siblings('.id_coverage').val();
            $('#id_coverage').val(sabor_c);
            sabor_cambio();
            switch ($('#opt_forma').val()) {
                case '1':
                    if($('#tamano').val() == '1'){
                        cuadrado_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                    }else{
                        cuadrado_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                    }
                break;
                case '2':
                    if($('#tamano').val() == '1'){
                        redondo_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                    }else{
                        redondo_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                    }
                break
            }
        });

        if($('#tamano').val() == '1'){
            $('.masa_1_2').click(function () { 
                sabor_m_1_2 = $(this).siblings('.id_doug_1_2').val();
                $('#id_doug_1_2').val(sabor_m_1_2);
                sabor_cambio();
                if($('#opt_forma').val() == '1'){
                    cuadrado_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                }
                else if($('#opt_forma').val() == '2'){
                    redondo_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                }   
            });
            $('.masa_3_4').click(function () { 
                sabor_m_1_2 = $(this).siblings('.id_doug_3_4').val();
                $('#id_doug_3_4').val(sabor_m_1_2);
                sabor_cambio();
                if($('#opt_forma').val() == '1'){
                    cuadrado_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                }
                else if($('#opt_forma').val() == '2'){
                    redondo_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                } 
            });
            $('.relleno').click(function () { 
                sabor_r = $(this).siblings('.id_filler').val();
                $('#id_filler').val(sabor_r);
                sabor_cambio();
                if($('#opt_forma').val() == '1'){
                    cuadrado_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                }
                else if($('#opt_forma').val() == '2'){
                    redondo_1_libra(sabor_c, sabor_m_1_2, sabor_m_3_4, sabor_r, borde);
                } 
            });   
        }else{
            $('.masa_m').click(function () { 
                sabor_masa_m = $(this).siblings('.id_doug').val();
                $('#id_doug').val(sabor_masa_m);
                sabor_cambio();
                if($('#opt_forma').val() == '1'){
                    cuadrado_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                }
                else if($('#opt_forma').val() == '2'){
                    redondo_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                }    
             }); 
    
            $('.relleno_1').click(function () { 
                sabor_r1 = $(this).siblings('.id_filler_1').val();
                $('#id_filler_1').val(sabor_r1);
                sabor_cambio();
                if($('#opt_forma').val() == '1'){
                    cuadrado_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                }
                else if($('#opt_forma').val() == '2'){
                    redondo_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                } 
            });
    
            $('.relleno_2').click(function () { 
                sabor_r2 = $(this).siblings('.id_filler_2').val();
                $('#id_filler_2').val(sabor_r2);
                sabor_cambio();
                if($('#opt_forma').val() == '1'){
                    cuadrado_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                }
                else if($('#opt_forma').val() == '2'){
                    redondo_m_libra(sabor_c, sabor_m, sabor_r1, sabor_r2, borde);
                }    
            });
        }

        blonda();
        return scene;
    }

    const canvas = document.getElementById('renderCanvas');
    const engine = new BABYLON.Engine(canvas, true);
    const scene = createScene();

    engine.runRenderLoop(function () {
        scene.render();
    });

    window.addEventListener('resize', function () {
        engine.resize();
    });
});

function sabor_cambio(){
    sabor_c = '', sabor_m_1_2 = '', sabor_m_3_4 = '', sabor_m = '', sabor_r = '', sabor_r1 = '', sabor_r2 = '';
    $('.lis_sabor .col').each(function () {
        if($('.'+$(this).find('.cubierta').siblings().val()).is(':checked'))
            sabor_c = $('#id_coverage').val();

        if($('.'+$(this).find('.masa_1_2').siblings().val()).is(':checked'))
            sabor_m_1_2 = $('#id_doug_1_2').val();

        if($('.'+$(this).find('.masa_3_4').siblings().val()).is(':checked'))
            sabor_m_3_4 = $('#id_doug_3_4').val();
        
        if($('.'+$(this).find('.masa_m').siblings().val()).is(':checked'))
            sabor_m = $('#id_doug').val();
        
        if($('.'+$(this).find('.relleno').siblings().val()).is(':checked'))
            sabor_r = $('#id_filler').val();

        if($('.'+$(this).find('.relleno_1').siblings().val()).is(':checked'))
            sabor_r1 = $('#id_filler_1').val();
        
        if($('.'+$(this).find('.relleno_2').siblings().val()).is(':checked'))
            sabor_r2 =$('#id_filler_2').val();
    }); 
}
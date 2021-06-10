function r_sabor(sabor, t){
    const Mat = new BABYLON.StandardMaterial("Mat");

    switch (sabor) {
        case 'vainilla':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.8);    
        break;
        case 'chocolate':
            Mat.diffuseColor = new BABYLON.Color3(0.7,0.4,0);    
        break;
        case 'fresa':
            Mat.diffuseColor = new BABYLON.Color3(1, 0, 0.5);    
        break;
        case 'limon':
            Mat.diffuseColor = new BABYLON.Color3(0.2,1,0);    
        break;
        case 'naranja':
            Mat.diffuseColor = new BABYLON.Color3(1,0.7,0.2);    
        break;
        default:
            Mat.diffuseColor = new BABYLON.Color3(1,1,1);
        break;
    }
  
    return Mat;
}

function color_b(color){
    const Mat = new BABYLON.StandardMaterial("Mat");

    switch (color) {
        case '3':
            Mat.diffuseColor = new BABYLON.Color3(0.9,0.85,0.45);    
        break;
        case '2':
            Mat.diffuseColor = new BABYLON.Color3(0.88,0.88,0.88);       
        break;
    }
    return Mat;
}

function color_cubierta(sabor){
    const Mat = new BABYLON.StandardMaterial("Mat");
    switch (sabor) {
        case '1':
            Mat.diffuseColor = new BABYLON.Color3(0.7,0.4,0);    
        break;
        case '2':
            Mat.diffuseColor = new BABYLON.Color3(0.5,0.2,0);    
        break;
        case '3':
            Mat.diffuseColor = new BABYLON.Color3(1,0.6,0.8);    
        break;
        case '4':
            Mat.diffuseColor = new BABYLON.Color3(0.6,0.3,0);    
        break;
        case '5':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.4);    
        break;
        case '6':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.1);    
        break;
        case '8':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.8);     
        break;
        case '9':
            Mat.diffuseColor = new BABYLON.Color3(0.5,0.3,0.1); 
        break;
        default:
            Mat.diffuseColor = new BABYLON.Color3(1,1,1);
        break;
    }
  
    return Mat;
}

function color_masa(sabor){
    const Mat = new BABYLON.StandardMaterial("Mat");

    switch (sabor) {
        case '1':
            Mat.diffuseColor = new BABYLON.Color3(1,0.9,0.5);    
        break;
        case '2':
            Mat.diffuseColor = new BABYLON.Color3(0.5,0.2,0);    
        break;
        case '3':
            Mat.diffuseColor = new BABYLON.Color3(0.4,0.9,0.1);    
        break;
        case '4':
            Mat.diffuseColor = new BABYLON.Color3(1,0.7,0.2);    
        break;
        case '5':
            Mat.diffuseColor = new BABYLON.Color3(0.7,0.1,0.1);    
        break;
        case '6':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.6);    
        break;
        case '7':
            Mat.diffuseColor = new BABYLON.Color3(1,0.9,0.1);    
        break;
        default:
            Mat.diffuseColor = new BABYLON.Color3(1,1,1);
        break;
    }
  
    return Mat;
}

function color_filler(sabor, t){
    const Mat = new BABYLON.StandardMaterial("Mat");

    switch (sabor) {
        case '1':
            Mat.diffuseColor = new BABYLON.Color3(0.7,0.4,0);    
        break;
        case '2':
            Mat.diffuseColor = new BABYLON.Color3(0.5,0.2,0);    
        break;
        case '3':
            Mat.diffuseColor = new BABYLON.Color3(0.6,0.3,0);    
        break;
        case '4':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.4);    
        break;
        case '5':
            Mat.diffuseColor = new BABYLON.Color3(1, 0, 0.5);    
        break;
        case '6':
            Mat.diffuseColor = new BABYLON.Color3(0.7,0,0.8 );    
        break;
        case '8':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.8);     
        break;
        case '9':
            Mat.diffuseColor = new BABYLON.Color3(0.5,0.3,0.1); 
        break;
        case '10':
            Mat.diffuseColor = new BABYLON.Color3(1,1,0.1);    
        break;
        default:
            Mat.diffuseColor = new BABYLON.Color3(1,1,1);
        break;
    }
  
    return Mat;
}

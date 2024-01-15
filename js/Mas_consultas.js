$(document).ready(function(){
    let funcion;
    venta_mes();
    vendedor_mes();
    producto_mas_vendido();
    async function producto_mas_vendido(){
        funcion='producto_mas_vendido';
        let lista=['','','','',''];
        const response = await fetch('../Controlador/VentaController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
        }).then(function(response){
            return response.json();
        }).then(function(productos){
            let i=0;
            productos.forEach(producto => {
                lista[i]=producto;
                i++;
            });
        })
        let CanvasG3=$('#Grafico3').get(0).getContext('2d');
        let datos={
            labels:[
                'Mes Actual'
            ],
            datasets:[
                {
                    label               :  lista[0].nombre+' '+lista[0].descripcion,
                    backgroundColor     :  'rgba(37, 168, 173, 0.53)',
                    borderColor         :  'rgba(37, 168, 173, 0.33)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(37, 168, 173, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(37, 168, 173, 1)',
                    data                :  [lista[0].total],
                },
                {
                    label               :  lista[1].nombre+' '+lista[1].descripcion,
                    backgroundColor     :  'rgba(255, 0, 0, 0.53)',
                    borderColor         :  'rgba(255, 0, 0, 0.33)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(255, 0, 0, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(255, 0, 0, 1)',
                    data                :  [lista[1].total],
                },
                {
                    label               :  lista[2].nombre+' '+lista[2].descripcion,
                    backgroundColor     :  'rgba(0, 168, 0, 0.53)',
                    borderColor         :  'rgba(0, 168, 0, 0.33)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(0, 168, 0, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(0, 168, 0, 1)',
                    data                :  [lista[2].total],
                },
                {
                    label               :  lista[3].nombre+' '+lista[3].descripcion,
                    backgroundColor     :  'rgba(253, 124, 59, 0.77)',
                    borderColor         :  'rgba(253, 124, 59, 0.77)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(253, 124, 59, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(253, 124, 59, 1)',
                    data                :  [lista[3].total],
                },
                {
                    label               :  lista[4].nombre+' '+lista[4].descripcion,
                    backgroundColor     :  'rgba(255, 255, 0, 1)',
                    borderColor         :  'rgba(255, 255, 0, 1)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(255, 255, 0, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(255, 255, 0, 1)',
                    data                :  [lista[4].total],
                },
            ]
        }
        let opciones={
            responsive:true,
            maintainAspectRatio:false,
            datasetFill:false,
        }
        let G3 = new Chart(CanvasG3,{
            type:'bar',
            data:datos,
            options:opciones,
        })
        

    }
    async function vendedor_mes(){
        funcion='vendedor_mes';
        let lista=['','',''];
        const response = await fetch('../Controlador/VentaController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
        }).then(function(response){
            return response.json();
        }).then(function(vendedores){
            let i=0
            vendedores.forEach(vendedor => {
                lista[i]=vendedor;
                i++;
            });
        })
        let CanvasG2=$('#Grafico2').get(0).getContext('2d');
        let datos={
            labels:[
                'Mes actual'
            ],
            datasets:[
                {
                    label               :  lista[0].vendedor_nombre,
                    backgroundColor     :  'rgba(37, 168, 173, 0.53)',
                    borderColor         :  'rgba(37, 168, 173, 0.33)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(37, 168, 173, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(37, 168, 173, 1)',
                    data                :  [lista[0].cantidad],
                },
                {
                    label               :  lista[1].vendedor_nombre,
                    backgroundColor     :  'rgba(255, 0, 0, 0.53)',
                    borderColor         :  'rgba(255, 0, 0, 0.33)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(255, 0, 0, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(255, 0, 0, 1)',
                    data                :  [lista[1].cantidad],
                },
                {
                    label               :  lista[2].vendedor_nombre,
                    backgroundColor     :  'rgba(0, 168, 0, 0.53)',
                    borderColor         :  'rgba(0, 168, 0, 0.33)',
                    pointRadius         :  false,
                    pointColor          :  '#133337',
                    pointStrokeColor    :  'rgba(0, 168, 0, 1)',
                    pointHighlightFill  :  '#fff',
                    pointHighlightStroke:  'rgba(0, 168, 0, 1)',
                    data                :  [lista[2].cantidad],
                },
            ]
        }
        let opciones={
            responsive:true,
            maintainAspectRatio:false,
            datasetFill:false,
        }
        let G2 = new Chart(CanvasG2,{
            type:'bar',
            data:datos,
            options:opciones,
        })
        
    }
    async function venta_mes(){
        funcion='venta_mes';
        let array=['','','','','','','','','','','','',];
        const response = await fetch('../Controlador/VentaController.php',{
            method: 'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion
        }).then(function(response){
            return response.json();
        }).then(function(meses){
            meses.forEach(mes => {
                if(mes.mes==1){
                    array[0]=mes;
                }
                if(mes.mes==2){
                    array[1]=mes;
                }
                if(mes.mes==3){
                    array[2]=mes;
                }
                if(mes.mes==4){
                    array[3]=mes;
                }
                if(mes.mes==5){
                    array[4]=mes;
                }
                if(mes.mes==6){
                    array[5]=mes;
                }
                if(mes.mes==7){
                    array[6]=mes;
                }
                if(mes.mes==8){
                    array[7]=mes;
                }
                if(mes.mes==9){
                    array[8]=mes;
                }
                if(mes.mes==10){
                    array[9]=mes;
                }
                if(mes.mes==11){
                    array[10]=mes;
                }
                if(mes.mes==12){
                    array[11]=mes;
                }
            });
        })
        let CanvasG1=$('#Grafico1').get(0).getContext('2d');
        let datos={
            labels:[
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre',
            ],
            datasets:[{
                data:[
                    array[0].cantidad,
                    array[1].cantidad,
                    array[2].cantidad,
                    array[3].cantidad,
                    array[4].cantidad,
                    array[5].cantidad,
                    array[6].cantidad,
                    array[7].cantidad,
                    array[8].cantidad,
                    array[9].cantidad,
                    array[10].cantidad,
                    array[11].cantidad,
                ],
                backgroundColor:[
                    '#aee8e1',
                    '#dc143c',
                    '#0e0f3b',
                    '#000000',
                    '#f9f6b9',
                    '#a5d805',
                    '#ff80ed',
                    '#ffff66',
                    '#999999',
                    '#b4eeb4',
                    '#40e0d0',
                    '#ffa500',
                ]
            }]
        }
        let opciones={
            maintainAspectRatio:false,
            responsive:true,
        }
        let G1 = new Chart(CanvasG1,{
            type: 'pie',
            data:datos,
            options:opciones,
        })
    }
})
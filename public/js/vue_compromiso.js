var compromiso = new Vue({
    el: '#compromiso',
    data:{
        listaCompromiso: [ ],
        actividad: '',
        responsable: '',
        date: '',
    },
    methods: {
        agregarCompromiso: function(){
            if (this.actividad != '' && this.responsable != '' && this.date != ''){
                this.lista.push({actividad: this.actividad, responsable:this.responsable, date: this.date});
                this.actividad = '';
                this.responsable = '';
                this.fecha = '';
            }else{
                alert('debe diligenciar todos los campos');
            }
        }
    }
})
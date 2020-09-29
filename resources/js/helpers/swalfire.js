export default {
    updateF(data, item) {
        return new Promise((res,rej)=>{
            Swal.fire({
                title: data.title,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1565c0',
                cancelButtonColor: '##0000008a',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    axios.post(data.url ,{
                        _method: 'put'
                    })
                    .then((response)=>{
                        res(response.data.message)
                    }) .catch((err)=> {
                        console.log(err)
                        rej(err)
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                    ){

                }
            })
        })
    },
    activeF(data) {
        return new Promise((res,rej)=>{
            Swal.fire({
                title: data.title,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1565c0',
                cancelButtonColor: '##0000008a',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.post(data.url ,{
                        _method: 'put'
                    })
                    .then((response)=>{
                        res(response.data.message)
                    }) .catch((err)=> {
                        console.log(err)
                        rej(err)
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                    ){

                }
            })
        })
    },
    desactiveF(data) {
        return new Promise((res,rej)=>{

            Swal.fire({
                title: data.title,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#b31d2b',
                cancelButtonColor: '##0000008a',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.post(data.url ,{
                        _method: 'put'
                    })
                    .then((response)=>{
                        res(response.data.message)
                    }) .catch((err)=> {
                        console.log(err)
                        rej(err)
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                    ){

                }
            })
        })
    },

    deleteF(data) {
        return new Promise((res,rej)=>{

            Swal.fire({
                thtml: '<pre class="h4" style="color:white">'+data.title +'</pre>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1565c0',
                cancelButtonColor: '##0000008a',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    let me=this;
                    axios.post(data.url ,{
                        _method: 'delete'
                    })
                    .then((response)=>{
                        res(response.data.message)
                    }) .catch((err)=> {
                        console.log(err)
                        rej(err)
                    });
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                    ){

                }
            })
        })
    }

}


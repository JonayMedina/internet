export function initialize(store,router){
	router.beforeEach((to, form, next) => {
		const requireAuth = to.matched.some(record=> record.meta.requireAuth);
		const currentUser = store.state.currentUser;

		if (requireAuth && !currentUser) {
			next({name:'login'});
		}else if(to.path == '/admincnet/' && currentUser != null || to.path == '/admincnet/login' && currentUser != null){
			next({name:'home'});
		} else{
			next();
		}
	});
	axios.interceptors.response.use(null,(error)=>{
		if (error.response.status == 401) {
			store.commit('logout');
            router.push({name:'login'});
            Swal.fire({
                position:'top-end',
                title:'Sesion Finalizada',
                text: 'Por Favor inicie sesion de Nuevo',
                showConfirmButton: false,
                timer: 3000
            });
		}
		return Promise.reject(error);
    });


	if (store.getters.currentUser) {
		setAuthorization(store.getters.currentUser.token)
    }

}
export function setAuthorization(token){
	axios.defaults.headers = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`}
}

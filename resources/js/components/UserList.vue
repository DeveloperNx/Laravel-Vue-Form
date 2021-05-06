<template>
	<div>
		<div class="container">
			<div class="row">
			<div class="col-8">
				<router-link to="/registration" class="btn btn-dark"><i class="fas fa-plus"> Add User</i></router-link>
			</div>
			<div class="col-4 search-filter">
				<i class="fas fa-search "></i>
				<input type="text" placeholder="search firstname..." v-model="search" />
				
			</div>
		</div>
		</div>
		<br>
		<!--  <ul v-if="userDetails.length > 0">
            <li v-for="result in userDetails" :key="result.id" v-text="result.firstname"></li>
        </ul> -->
		<table class="table table-bordered">
			<thead>
				<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Address</th>
				<th>Contact Number</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
			</thead>
			<tbody v-if="userDetails">
			<tr v-for="ud in filteredList" :key="ud.id">
				<td>{{ud.firstname}}</td>
				<td>{{ud.lastname}}</td>
				<td>{{ud.address}}</td>
				<td>{{ud.contactnumber}}</td>
				<td>{{ud.email}}</td>
				<td>{{ud.gender}}</td>
				<td text-center><router-link :to="{name: 'EditUserData', params: { id: ud.id }}"><i class="far fa-edit fa-2x"></i>
                        </router-link></td>
				<td><a href="javascript:void(0)" @click="deleteUser(ud.id)"><i class="far fa-trash-alt fa-2x"></i></a></td>
			</tr>
			</tbody>
			<!-- <tbody v-else>
                <tr>
                    <td align="center" colspan="8">No record found.</td>
                </tr>
            </tbody> -->
		</table>
		<pagination align="center" :data="userDetails" @pagination-change-page="getDetails"></pagination>
	</div>
</template>
<script>
	 import pagination from 'laravel-vue-pagination';
	export default{
		 components:{
            pagination
        },
		data:function(){
			return{
				 userDetails:[],
				  search: ''
			};
		},

		/* watch: {
        	keywords(after, before) {
            this.fetch();
        }
    	},*/

		created(){
			this.getDetails();
			// this.fetch();
		},

	computed: {
    filteredList() {
      return this.userDetails.data.filter(ud => {
        return ud.firstname.toLowerCase().includes(this.search.toLowerCase())
      })
    }
},

		methods:{	

			// send:function(){
			// 	router.push({ path: '/' })
			// },

			// getDetails(){
			// 	return axios.get('/api/list')
			// 	.then(response=>{
			// 		this.userDetails=response.data.data;
			// 		console.log(response.data.data);
			// 	});
			// },

			// updateUserData(id){
			// 	this.$router.push({name:'EditUserData',params:{id:id}},);
				
			// },

			/*        	*/
			async getDetails(page=1){
                await axios.get(`/api/list?page=${page}`).then(({data})=>{
                    this.userDetails = data;
                }).catch(({ response })=>{
                    console.error(response)
                })
            },
        

			deleteUser(id){
				if(confirm('are you sure you want to delete?'))
				return axios.get('/api/delete/'+id)
				.then(response=>{
					this.userDetails= this.userDetails.filter(userDetails=>userDetails.id!=id)
				});
		},
	}
}
</script>

<style>
.btn-dark{
	margin:25px 0 0 25px;
}

.search-filter{
	margin-top: 25px;
}
</style>
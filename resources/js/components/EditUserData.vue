<template>
  <div class="register-form">
  	<form>
  	<div class="card">
  		<div class="card-header">
  			<h2>Update User Data Form</h2>
  		</div>
  		<div class="card-body">
  			<div class="container">
  				<div class="row">
  					<div class="col-lg-4">
  						<label class="label-name">First Name</label>
  					</div>
  					<div class="col-lg-8">
  						<input type="text" placeholder="Enter Your First Name" name="firstname" class="form-control" v-model.trim="$v.Details.firstname.$model" v-model="Details.firstname"/>
  						<label v-if="submitted &&!$v.Details.firstname.required" class="error">First Name is required</label>
  						 <label v-if="submitted &&!$v.Details.firstname.alpha" class="error">First name must contain only letters </label>
  					</div>
  				</div>
  				<br>
  				<div class="row">
  					<div class="col-lg-4">
  						<label class="label-name">Last Name</label>
  					</div>
  					<div class="col-lg-8">
  						<input type="text" placeholder="Enter Your Last Name" name="lastname" class="form-control" v-model.trim="$v.Details.lastname.$model"  v-model="Details.lastname"  />
  						<label v-if="submitted &&!$v.Details.lastname.required" class="error">Last Name is required</label>
  						 <label v-if="submitted &&!$v.Details.lastname.alpha" class="error">Last name must contain only letters </label>
  					</div>
  				</div>
  				<br>
  				<div class="row">
  					<div class="col-lg-4">
  						<label class="label-name">Address</label>
  					</div>
  					<div class="col-lg-8">
  						<textarea  type="text" placeholder="Enter Your Address" name="address" class="form-control" v-model.trim="$v.Details.address.$model" v-model="Details.address"></textarea>
  						<label v-if="submitted &&!$v.Details.address.required" class=" error">Address is required</label>
  					</div>
  				</div>
  				<br>
  				<div class="row">
  					<div class="col-lg-4">
  						<label class="label-name">Contact Number</label>
  					</div>
  					<div class="col-lg-8">
  						<input type="text" placeholder="Enter Your Contact Number" name="contactnumber" class="form-control" v-model.trim="$v.Details.contactnumber.$model" v-model="Details.contactnumber" maxlength="10" />
  						<label v-if="submitted &&!$v.Details.contactnumber.required" class="error">Contact number is required</label>
  						<label v-if="submitted &&!$v.Details.contactnumber.numeric" class="error">Contact number must be number</label>
  					</div>
  				</div>
  				<br>
  				<div class="row">
  					<div class="col-lg-4">
  						<label class="label-name">Email Id</label>
  					</div>
  					<div class="col-lg-8">
  						<input type="text" placeholder="Enter Your Email Id" name="email" class="form-control" v-model.trim="$v.Details.email.$model" v-model="Details.email" />
  						<label v-if="submitted &&!$v.Details.email.required" class="error">Email is required</label>
  						 <label v-if="submitted &&!$v.Details.email.email" class="error">Email must have valid formate </label>
  					</div>
  				</div>
  				<br>
  				<div class="row">
  					<div class="col-lg-4">
  						<label class="label-name">Gender</label>
  					</div>
  					<div class="col-lg-8">
  						 <input type="radio" name="gender" id="radbtn1" value="female" v-model.trim="$v.Details.gender.$model" v-model="Details.gender">
         				 <label for="radbtn1">Female</label>
         				 <br>
         				  <input type="radio" name="gender" id="radbtn2" value="male" v-model.trim="$v.Details.gender.$model" v-model="Details.gender">
         				 <label  for="radbtn2">Male</label>
         				 <br>
         				 <label v-if="submitted &&!$v.Details.gender.required" class="error">Gender is required</label>
  					</div>
  				</div>
  					<br>
  				<div class="row btn-submit">
  					<div class="col-lg-12">
  						<button class="btn btn-primary submit" @click.prevent="send">Update</button>
  					</div>
  				</div>
  			</div>
  	</div>
  	</div>
  </form>
  </div>	
</template>

<style>
.register-form{
	font-family: 'Poppins', sans-serif;
	margin-top: 10px;
}
.card-header{
	text-align: center;
	text-transform: uppercase;
}
.card{
	height: 750px;
	width:560px;
	margin:auto;
	/*background-image: linear-gradient(lightblue,lightpink);	*/
}
.label-name{
    font-size: 16px;
    padding-top: 5px;
}
.btn-submit{		
	text-align: center;
	text-transform: uppercase;
}
.btn-primary{
	text-transform: uppercase;
    font-size: 18px;
    font-weight: 500;
}

.btn-primary:hover{
		background-color: black;
}
.error{
	color: red;
}
</style>

<script>
	import axios from "axios";
	import Vuelidate from 'vuelidate';
	import {email,numeric,required,alpha} from 'vuelidate/lib/validators'
    export default {
       data:function(){
       	return {
       		Details:{
       			firstname:null,
       			lastname:null,
       			address:null,
       			contactnumber:null,
       			email:null,
       			gender:null,
       		},
       		submitted:false,
       	};
       },
       validations:{
       	Details:{
       		firstname:{required,alpha},
       		lastname:{required,alpha},
       		address:{required},
       		contactnumber:{required,numeric},
       		email:{required,email},
       		gender:{required},
       }
   },

    created() {
            return axios
                .get('/api/edit/'+this.$route.params.id)
                .then((response) => {
                    this.Details = response.data;
                    console.log(response.data);
                });
        },

   methods:{
   	send:function(){
   		 this.$v.Details.$touch(); //validate all fields
             this.submitted = true
            if (this.$v.Details.$error) {
                return
      		}

          var data=this.Details;
          console.log(data);
          return axios.post('/api/update/'+this.$route.params.id, data)
          .then(response=>{
              this.$router.push({name: 'UserList'});
            }); 
   	},

    // getDetails(){
    //     return axios.get('/api/list')
    //     .then(response=>{
    //       this.userDetails=response.data.data;
    //       console.log(response.data.data);
    //     });
    //   }


   	}
    }
</script>
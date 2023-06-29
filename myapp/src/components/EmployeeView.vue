<template>
    <div>
        <div class="row">
        <div class="mx-auto col-10 col-md-8 col-lg-6">

        <h2>Employee Registration</h2>
    <form @submit.prevent="save">
        <div class="form-group">
            <label>Employee Name:</label>
             <input type="text" v-model="employee.name" class="form-control" placeholder="Name">
        </div> 
        <div class="form-group">
            <label>Employee Email:</label>
            <input type="email" v-model="employee.email" class="form-control" placeholder="Email">
        </div> 
        <div class="form-group">
            <label>Mobile:</label>
            <input type="text" v-model="employee.mobile" class="form-control" placeholder="Mobile">
        </div> 
        <div class="form-group">
            <label>County:</label>
            <input type="text" v-model="employee.county" class="form-control" placeholder="County">
        </div> 
        <div class="form-group">
            <label>Ward:</label>
            <input type="text" v-model="employee.ward" class="form-control" placeholder="Ward">
        </div> 
        
        <button type="submit" class="btn btn-primary">Save</button>
        
    </form>
    </div>
    </div>

      <h2>Employee View</h2>
    <table class="table table-dark">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">County</th>
      <th scope="col">Ward</th>
      <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="employee in result" v-bind:key="employee.id">
      <th>{{ employee.id }}</th>
      <td>{{ employee.name }}</td>
      <td>{{ employee.email }}</td>
      <td>{{ employee.mobile }}</td>
      <td>{{ employee.county }}</td>
      <td>{{ employee.ward }}</td>
      <td>
        <button type="button" class="btn btn-warning" @click="edit(employee)">Edit</button>
        <button type="button" class="btn btn-danger"  @click="remove(employee)">Delete</button>
      </td>
    </tr>
    </tbody>
    </table>
      
    </div>
    </template>
  
  <script>

    import Vue from 'vue';
    import axios from 'axios';

    Vue.use(axios)

  export default {
    name: 'EmployeeView',
    data () {
      return {
        result: {},
        employee:{
            id: '',
            name: '',
            email: '',
            mobile: '',
            county: '',
            ward: ''
        }
      }
    },
    created() {
        this.EmployeeLoad();
    },
    methods: {
        EmployeeLoad () 
        {
            var page = "http://127.0.0.1:8000/api/employees";
            axios.get(page)
            .then( 
                ({data}) => {
                    console.log(data);
                    this.result = data;
                }
            );
        },
        save()
        {
            if(this.employee.id == '')
            {
                this.saveData();
            }else{
                this.updateData();
            }
            
        },
        saveData()
        {
            axios.post("http://127.0.0.1:8000/api/save", this.employee)
            .then(
                ({data}) => {
                    alert("saved");
                    this.EmployeeLoad();
                }
            )

        },
        edit(employee)
        {
            this.employee = employee;
        },
        updateData()
        {
            var editurl = 'http://127.0.0.1:8000/api/update/'+ this.employee.id;
            axios.put(editurl, this.employee)
            .then(
                ({data}) =>{
                    this.employee.name = '', 
                    this.employee.email = '',
                    this.employee.mobile = '',
                    this.employee.county = '',
                    this.employee.ward = '',
                    this.id = ''
                    alert("Updated!!");
                    this.EmployeeLoad();
                }
            )
        },
        remove(employee)
        {
            // var url = 'http://127.0.0.1:8000/api/delete/${employee.id}'; //alternative way
            var url = 'http://127.0.0.1:8000/api/delete/'+ employee.id;
            axios.delete(url);
            alert("Deleted");
            this.EmployeeLoad();
        }
    }
  }
  </script>
  
  
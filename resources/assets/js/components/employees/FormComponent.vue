<template>
   <div class="container col-8">
       <form>
           <div class="form-group">
               <label for="first_name">Имя</label>
               <input type="text"
                      class="form-control"
                      id="first_name"
                      name="first_name"
                      v-model.trim="employee.first_name"
                      placeholder="Введите имя"
                      v-validate="'required|max:60'"
                      data-vv-as="Firs Name"
               >
               <div v-if="errors.has('first_name')" class="help-block alert alert-danger">{{ errors.first('first_name') }}</div>
               <div v-if="errors_b && errors_b.first_name" class="help-block alert alert-danger">{{ errors_b.first_name[0] }}</div>
           </div>
           <div class="form-group">
               <label for="second_name">Фамилия</label>
               <input type="text"
                      class="form-control"
                      id="second_name"
                      name="second_name"
                      v-model.trim="employee.second_name"
                      placeholder="Введиет фамилию"
                      v-validate="'required|max:60'"
                      data-vv-as="Second Name"
               >
               <div v-if="errors.has('second_name')" class="help-block alert alert-danger">{{ errors.first('second_name') }}</div>
               <div v-if="errors_b && errors_b.second_name" class="help-block alert alert-danger">{{ errors_b.second_name[0] }}</div>
           </div>
           <div  v-if="positions" class="form-group">
               <label for="position">Должность</label>
               <select id="position"
                       class="form-control"
                       name="position"
                       v-model="employee.position_id"
                       v-validate="'required'"
                       data-vv-as="Position"
               >
                   <option value="" selected disabled>Выберете должность</option>
                   <option v-for="position in positions" :value="position.id">{{position.name}}</option>
               </select>
               <div v-if="errors.has('position')" class="help-block alert alert-danger">{{ errors.first('position') }}</div>
               <div v-if="errors_b && errors_b.position" class="help-block alert alert-danger">{{ errors_b.position[0] }}</div>
           </div>
           <div class="form-group">
               <label for="features">Характеристика</label>
               <textarea class="form-control"
                         id="features"
                         rows="3"
                         v-model="employee.features"
                         placeholder="Разкажите о работнике"
                         name="features"
                         v-validate="'max:254'"
               ></textarea>
               <div v-if="errors.has('features')" class="help-block alert alert-danger">{{ errors.first('features') }}</div>
               <div v-if="errors_b && errors_b.features" class="help-block alert alert-danger">{{ errors_b.features[0] }}</div>
           </div>
           <div class="form-group">
               <label for="salary">Зарплата (€)</label>
               <input type="number"
                      min="0"
                      class="form-control has-warning"
                      id="salary"
                      name="salary"
                      v-model.number="employee.salary"
                      placeholder="Укажите зарплату"
                      v-validate="'decimal:2'"
               >
               <div v-if="errors.has('salary')" class="help-block alert alert-danger">{{ errors.first('salary') }}</div>
               <div v-if="errors_b && errors_b.salary" class="help-block alert alert-danger">{{ errors_b.salary[0] }}</div>
           </div>
           <button type="submit" v-on:click.prevent="saveEmployee" class="btn btn-primary">Сохранить</button>
       </form>
   </div>
</template>

<script>


    export default {
        name: "employee_form",
        props: ['employee_id'],
        data: function () {
            return {
                positions: [],
                employee: {
                    first_name: '',
                    second_name: '',
                    position_id: '',
                    features: '',
                    salary: ''
                },
                errors_b: null,
            }
        },
        created() {
            this.getPositions();

            if (this.employee_id) {
                this.getEmployee(this.employee_id);
            }
        },
        methods: {
            getEmployee(id){
                axios.get('/api/employee/'+id).then((response) => {
                    this.employee.first_name = response.data.first_name;
                    this.employee.second_name = response.data.second_name ;
                    this.employee.position_id = response.data.position_id ;
                    this.employee.features = response.data.features ;
                    this.employee.salary = response.data.salary ;
                }).catch((e) => {
                    alert( "Произошла ошибка!" );
                    window.location = '/employees';
                });
            },
            getPositions() {
                axios.get('/api/positions').
                then( response => {
                    this.positions = response.data;
                });
            },
            saveEmployee() {
                this.errors_b = null;
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if (!this.employee_id) {
                            axios.put('/api/employee', this.employee)
                                .then((response) => {
                                    alert("Данные добавлены!");
                                    window.location = '/employees';
                                })
                                .catch((e) => {
                                    if (e.response && e.response.status === 400) {
                                        this.errors_b = e.response.data;
                                        window.location = '/employees';
                                    }
                                });
                        } else {
                            axios.post('/api/employee/' + this.employee_id, this.employee)
                                .then((response) => {
                                    alert("Данные сохранены!");
                                    window.location = '/employees';
                                })
                                .catch((e) => {
                                    if (e.response && e.response.status === 400) {
                                        this.errors_b = e.response.data;
                                        window.location = '/employees';
                                    }
                                });
                        }
                    }
                });

                }
            }
    }
</script>

<style scoped>

</style>
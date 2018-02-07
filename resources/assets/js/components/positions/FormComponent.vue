<template>
    <div class="container col-8">
        <form>
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text"
                       class="form-control"
                       id="name"
                       name="name"
                       v-model.trim="position.name"
                       v-validate="'required|min:2|max:60'"
                       data-vv-as="Name"
                       placeholder="Введите название должности"
                       autofocus
                >
                <div v-if="errors.has('name')" class="help-block alert alert-danger">{{ errors.first('name') }}</div>
                <div v-if="errors_b && errors_b.name" class="help-block alert alert-danger">{{ errors_b.name[0] }}</div>
            </div>
            <div class="form-group">
                <label for="features">Описание</label>
                <textarea class="form-control"
                          id="features"
                          rows="3"
                          name="description"
                          v-model="position.description"
                          v-validate="'max:254'"
                          data-vv-as="Description"
                          placeholder="Описание должности"></textarea>
                <div v-if="errors.has('description')" class="help-block alert alert-danger">{{ errors.first('description') }}</div>
                <div v-if="errors_b && errors_b.description" class="help-block alert alert-danger">{{ errors_b.description[0] }}</div>
            </div>
            <button type="submit" v-on:click.prevent="savePosition" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</template>

<script>


    export default {
        name: "position_form",
        props: ['position_id'],
        data: function () {
            return {
                position: {
                    name: '',
                    description: '',
                },
                errors_b: null,
            }
        },
        created() {
          if(this.position_id) {
              this.getPosition(this.position_id);
          }
        },
        computed: {

        },
        methods: {
            getPosition(id) {
                axios.get('/api/position/'+id).then((response) => {
                    console.log(response);
                    this.position.name = response.data.name;
                    this.position.description = response.data.description;
                }).catch((e) => {
                    alert( "Произошла ошибка!" );
                    console.log(e.response);
                });
            },
            savePosition() {
                this.errors_b = null;
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        if(!this.position_id) {
                        axios.put('/api/position', this.position)
                            .then((response) => {
                                alert( "Данные добавлены!" );
                                console.log(window.location.hostname);
                                window.location = '/positions';
                            })
                            .catch((e) => {
                                if (e.response && e.response.status === 400) {
                                    this.errors_b = e.response.data;
                                }
                            });
                        } else {
                            axios.post('/api/position/'+this.position_id, this.position)
                                .then((response) => {
                                    alert("Данные сохранены!");
                                    window.location = '/positions';
                                })
                                .catch((e) => {
                                    if (e.response && e.response.status === 400) {
                                        this.errors_b = e.response.data;
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


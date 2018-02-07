<template>
    <div>
        <h1>Positions list</h1>
        <data-tables v-if="positions"
                     :data="positions"
                     :show-action-bar="false"
                     style="width: 100%"
                     :pagination-def="paginationDef"
                     :sort-method="sortMethod"
        >
            <el-table-column
                    prop="name"
                    label="Название должности"
                    sortable="custom"
            >
            </el-table-column>

            <el-table-column
                    prop="description"
                    label="Описание должности"
                    sortable="custom"
            >
            </el-table-column>

            <el-table-column
                    label="Редактировать"
            >
                <template slot-scope="scope">
                    <tr>
                        <a class="btn btn-warning" v-bind:href="'position/'+scope.row.id+'/edit'">Редактировать</a>
                    </tr>
                </template>
            </el-table-column>

            <el-table-column
                    label="Удалить"
            >
                <template slot-scope="scope">
                    <tr>
                        <button class="btn btn-danger" v-on:click="delPosition(scope.row)" >Удалить</button>
                    </tr>
                </template>
            </el-table-column>

        </data-tables>
    </div>

</template>

<script>
    export default {
        name: "positions_list",
        data: function () {
            return {
                positions: [],
                paginationDef: {
                    show: false
                },
            }
        },
        created() {
            this.getPositions();
        },
        methods: {
            delPosition(position) {
                let result = false;
                result = confirm('Вы уверены что хотите удалить должность '+position.name+'?');
                if(result == true) {
                    axios.delete('api/position/'+position.id).then(() => {
                        this.getPositions();
                    }).catch((e) => {
                        if(e.response.data && e.response.status === 400){
                            let users = e.response.data;
                            console.log(e.response.data);
                            let names = '';
                            /*for (let key in users) {
                                names += '\n'+users[key].first_name;
                            }*/
                            users.forEach((user) => {
                                names += '\n'+user.first_name+' '+user.second_name;
                            });
                            alert('Сначала нужно уволить:' + names);
                        }
                    });
                }
            },
            getPositions() {
                axios.get('api/positions').then((response) => {
                    this.positions = response.data;
                });
            },
            sortMethod(a, b) {
                if (a == null) {
                    return +1;
                }
                if (b == null) {
                    return -1;
                }
                if(typeof a == 'string' || typeof b == 'string') {
                    a += '';
                    b += '';
                    a = a.toUpperCase();
                    b = b.toUpperCase();
                }
                return a > b ? 1 : a < b ? -1 : 0;
            }
        }

    }
</script>

<style scoped>

</style>
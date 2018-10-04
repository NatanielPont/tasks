<template>
    <div >
        <h1 class="text-center text-red ">Tasques ({{total}})</h1>
        <input type="text"
               v-model="newTask" @keyup.enter="add" class="m-3 mt-5 p-4 shadow-lg border rounded focus:shadow-outline text-black-50"
               viewBox="0 0 20 20">
        <button @click="add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                 class="h-5 w-5"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg></button>
        <ul class="text-green-darker m-2 pl-5">
            <li v-for="task in filteredTasks" :key="task.id" >
                <span :class="{ strike: task.completed }">{{task.name}}</span>
                &nbsp;
                <span @click="remove(task)">&#215;</span>

            </li>
        </ul>
        <h3 class="text-center">Filtres</h3>
        Active filter {{filter}}
        <ul class="text-green-darker m-2 pl-5">
            <li ><button @click="setFilter('all')">Totes</button></li>
            <li ><button @click="setFilter('completed')">Completes</button></li>
            <li ><button @click="setFilter('active')">Pendents</button></li>
        </ul>
    </div>
</template>


<script>
    var filters={
        all: function (tasks) {
            return tasks;
        },
        completed: function (tasks) {
            return tasks.filter(function (task) {
                return task.completed
            })
        },
        active: function (tasks) {
            return tasks.filter(function (task) {
                return !task.completed
            })
            
        }
    }

    export default {
        data() {
            return {
                filter:'all',
                newTask: '',
                tasks: [
                    {
                        id: 1,
                        name: 'Comprar pa',
                        completed: false
                    },
                    {
                        id: 2,
                        name: 'Comprar llet',
                        completed: true
                    },
                    {
                        id: 3,
                        name: 'Estudiar PHP',
                        completed: true
                    }
                ]
            }
        },
        computed:{
            total(){
                return this.tasks.length
            },
            filteredTasks(){
                return filters[this.filter](this.tasks)
            }

        },
        methods: {
            add() {
                this.tasks.splice(0,0,{ name: this.newTask, completed: false } )
                this.newTask=''
            },
            remove(task) {
                this.tasks.splice(this.tasks.indexOf(task),1)
            },
            setFilter(filter){
                console.log(filter);
                this.filter=filter
            }
        }
    }
</script>

<style>
    .strike {
        text-decoration: line-through;
    }
</style>
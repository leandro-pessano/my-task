require('./bootstrap');

var app = new Vue ({
    el: '#app',
    data: {
        taskID : 0,
        taskTitle : 0,
        taskContent : 0,
        display : 0,
    },
    methods: {
        taskInfo(task){
            this.taskID = task.id;
            this.taskTitle = task.title;
            this.taskContent = task.content;
            this.display = 0;
        },
        dsplNew(){
            this.display = 'new';
        },
        dsplEdit(){
            this.display = 'edit';
        },
        updateTask(){
            var updTask = "task/" + this.taskID;
            return updTask;
        }
    },
});
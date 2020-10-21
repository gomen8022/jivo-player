var app = new Vue({
    el: '#app',
    data: {
        tasks: [],
        name: '',
        files: [],
        link: '',
        often: '',
        unique: '',
        errors: [],
        order: 'reg_date',
        toggleEdit: false,
        currPage: 1,
        password: '123',
        file: '',
        pages: '',
        mode: 1,
        toggleDone: false,
        active_el: '',
        errorTask: '',
    },
    mounted() {
        this.fetchTasks(this.currPage, this.order);
    },
    methods: {
        fetchTasks(currPage, order) {
            axios.post('/fetchTasks',
                {
                    currPage: currPage,
                    order: order
                })
                .then(response => {
                    // console.log(response.data.tasks);
                    this.tasks = response.data.tasks;
                    this.currPage = response.data.currPage;
                    this.order = response.data.order;
                    console.log(this.tasks);
                })
        },
        add_task: function (event) {
            event.preventDefault();
            this.errors = [];
            if (!this.name) {
                this.errors.push('required field name');
            }
            if (!this.link) {
                this.errors.push('required field link');
            }
            if (!this.often) {
                this.errors.push('required field often');
            }
            if (!this.file) {
                this.errors.push('required field file');
            }
            if (!this.unique) {
                this.errors.push('required field unique');
            }
            if (this.errors.length === 0) {
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('name', this.name);
                formData.append('link', this.link);
                formData.append('often', this.often);
                formData.append('unique', this.unique);

                axios({
                    method: 'post',
                    url: '/add',
                    data: formData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                    .then( response => {
                        // if (!response.data) {
                        //     console.log(response.data);
                        // } else {
                        //     window.location.href = '/';
                        // }
                        window.location.href = '/';
                    });
            }
        },
        login: function (event) {
            event.preventDefault();
            this.errors = [];

            if (!this.login) {
                this.errors.push('required field login');
            }
            if (!this.password) {
                this.errors.push('required field password');
            }
            axios.post('/logIn',
                {
                    name: this.name,
                    password: this.password,
                })
                .then( response => {
                    console.log(response.data);
                    // if (!response.data) {
                    //     console.log(response.data);
                    // } else {
                    //     window.location.href = '/';
                    // }
                    window.location.href = '/';
                });
        },
        changeToggle() {
            this.toggleEdit = !this.toggleEdit;
            console.log(this.toggleEdit);
        },
        deleteTask(id) {
            let formData = new FormData();
            formData.append('id', id);
            axios({
                    method: 'post',
                    url: '/delete',
                    data: formData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then( response => {
                    // if (!response.data.search("false")) {
                    //     this.errorTask = 'Please Login';
                    // } else {
                    // }
                    window.location.href = '/';
                });
        },
        handleFileUpload() {
            console.log(event.target.files[0]);
            this.files = event.target.files[0];
            this.file = this.$refs.file.files[0];
        },
        activate:function(el){
            this.active_el = el;
        },
        edit(id, name, file, link, often, unique) {

            let formData = new FormData();
            formData.append('id', id);
            formData.append('file', file);
            formData.append('name', name);
            formData.append('link', link);
            formData.append('often', often);
            formData.append('unique', unique);
            axios({
                    method: 'post',
                    url: '/edit',
                    data: formData,
                    headers: {'Content-Type': 'multipart/form-data' }
                })
                .then( response => {
                    // if (!response.data.search("false")) {
                    //     this.errorTask = 'Please Login';
                    // } else {
                    // }
                    window.location.href = '/';
                });
        },
        changeToggleDone() {
            this.toggleEdit = !this.toggleEdit;
            this.toggleDone = !this.toggleDone;
        },
        nextPage(){
            this.currPage++;
            this.fetchTasks(this.currPage, this.order, this.order_by);
        },
        prevPage(){
            this.currPage--;
            this.fetchTasks(this.currPage, this.order, this.order_by);
        },
        changeOrder(order){
            this.mode++;
            if (this.mode % 2){this.order_by = 'DESC'}else{this.order_by = 'ASC'}
            this.order = order;
            this.fetchTasks(this.currPage, this.order, this.order_by);
        }
    }
});
<template>
    <!-- List Menubar content -->
    <div class="wrapper">
        <div class="page-header page-header-default">
            <div class="container-fluid">
                <div class="add-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" :class="{'has-error':errors.name}">
                                <label class="control-label" for="menu_name">Menu Name</label>
                                <input type="text" class="form-control" id="menu_name" placeholder="Menu Name" v-model="menu.name">
                                <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" :class="{'has-error':errors.url}">
                                <label class="control-label" for="menu_url">Menu URL</label>
                                <input type="text" class="form-control" id="menu_url" placeholder="Menu URL" v-model="menu.url">
                                <small v-if="errors.url" class="text-danger">{{ errors.url[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="parent_menu">Parent Menu</label>
                                <select class="form-control" v-model="menu.parent_id">
                                    <option v-for="menu in menus" :key="menu.id" :value="menu.id" >{{ menu.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" :class="{'has-error':errors.sort_order}">
                                <label class="control-label" for="sort_order">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" placeholder="Sort Order" v-model="menu.sort_order">
                                <small v-if="errors.sort_order" class="text-danger">{{ errors.sort_order[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" style="display: block; margin-top: 8px;">Is Active</label>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_active" id="active_menu_add" value="1" v-model="menu.is_active">
                                        Active
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_active" id="inactive_menu_add" value="2" v-model="menu.is_active">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <button type="button" class="primary-btn" @click='add_menu'><i class="fa fa-plus" aria-hidden="true"></i> Add Menu</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Menu Name</th>
                        <th>Menu URL</th>
                        <th>Sort Order</th>
                        <th>Is Active</th>
                        <th>Sub-Menu</th>
                        <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(parent_menu_info,key) in menus" :key="parent_menu_info.key">
                        <td>{{ key+1 }}</td>
                        <td>{{ parent_menu_info.name }}</td>
                        <td>{{ parent_menu_info.url }}</td>
                        <td>{{ parent_menu_info.sort_order }}</td>
                        <td>{{ parent_menu_info.is_active }}</td>
                        <td><a @click="showChildMenu(parent_menu_info.id,parent_menu_info.name)" data-toggle="modal" data-target="#show_child_menu"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                        <td><a @click="editParentMenu(key,parent_menu_info.id,parent_menu_info.name)" data-toggle="modal" data-target="#edit_parent_menu"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                        <td><a @click="deleteParentMenu(key,parent_menu_info.id)"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!--Show child menu Modal -->
        <div class="modal fade" id="show_child_menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> {{ parent_name }} - Sub-Menu</h4>
                </div>
                <div class="modal-body">
                    <div v-if="child_form_add" class="add-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error':child_errors.name}">
                                    <label class="control-label" for="menu_name">Menu Name</label>
                                    <input type="text" class="form-control" id="menu_name" placeholder="Menu Name" v-model="editable_child_menu_info.name">
                                    <small v-if="child_errors.name" class="text-danger">{{ child_errors.name[0] }}</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error':child_errors.url}">
                                    <label class="control-label" for="menu_url">Menu URL</label>
                                    <input type="text" class="form-control" id="menu_url" placeholder="Menu URL" v-model="editable_child_menu_info.url">
                                    <small v-if="child_errors.url" class="text-danger">{{ child_errors.url[0] }}</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error':child_errors.parent_id}">
                                    <label class="control-label" for="parent_menu">Parent Menu</label>
                                    <select class="form-control" v-model="editable_child_menu_info.parent_id">
                                        <option v-for="menu in menus" :key="menu.id" :value="menu.id" >{{ menu.name }}</option>
                                    </select>
                                    <small v-if="child_errors.parent_id" class="text-danger">{{ child_errors.parent_id[0] }}</small>
                                    <!-- <input type="text" class="form-control" id="parent_menu" placeholder="Parent Menu" v-model="menu.parent_menu"> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error':child_errors.sort_order}">
                                    <label class="control-label" for="sort_order">Sort Order</label>
                                    <input type="number" class="form-control" id="sort_order" placeholder="Sort Order" v-model="editable_child_menu_info.sort_order">
                                    <small v-if="child_errors.sort_order" class="text-danger">{{ child_errors.sort_order[0] }}</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label mt-5" style="display: block">Is Active</label>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="is_active_child_add" id="active_menu_add" value="1" v-model="editable_child_menu_info.is_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="is_active_child_add" id="inactive_menu_add" value="2" v-model="editable_child_menu_info.is_active">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="button" class="primary-btn" @click='updateChildMenu'><i class="fa fa-refresh" aria-hidden="true"></i> Update Sub-Menu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                            <th>Menu Id</th>
                            <th>Menu Name</th>
                            <th>Menu URL</th>
                            <th>Sort Order</th>
                            <th>Is Active</th>
                            <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(childmenu,key) in childmenus" :key="childmenu.key">
                            <td>{{ childmenu.id }}</td>
                            <td>{{ childmenu.name }}</td>
                            <td>{{ childmenu.url }}</td>
                            <td>{{ childmenu.sort_order }}</td>
                            <td>{{ childmenu.is_active }}</td>
                            <td><a @click="childMenuEdit(key,childmenu.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td><a @click="childMenuDelete(key,childmenu.id)"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <!--Edit parent menu Modal -->
        <div class="modal fade" :class="{in: modalShow}" tabindex="-1" :style="myStyle">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button @click="modalToggle" type="button" class="close"><span>&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update - {{ parent_name }} Menu</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" :class="{'has-error':update_errors.name}">
                                <label class="control-label" for="menu_name_edit">Menu Name</label>
                                <input type="text" class="form-control" id="menu_name_edit" placeholder="Menu Name" v-model="editable_parent_menu_info.name">
                                <small v-if="update_errors.name" class="text-danger">{{ update_errors.name[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="menu_url_edit">Menu URL</label>
                                <input type="text" class="form-control" id="menu_url_edit" placeholder="Menu URL" v-model="editable_parent_menu_info.url">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" :class="{'has-error':update_errors.sort_order}">
                                <label class="control-label" for="sort_order_edit">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order_edit" placeholder="Sort Order" v-model="editable_parent_menu_info.sort_order">
                                <small v-if="update_errors.sort_order" class="text-danger">{{ update_errors.sort_order[0] }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" style="display: block; margin-top: 8px;">Is Active</label>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_active_update" id="active_menu_add" value="1" v-model="editable_parent_menu_info.is_active">
                                        Active
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_active_update" id="inactive_menu_add" value="2" v-model="editable_parent_menu_info.is_active">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <button type="button" class="primary-btn" @click='update_parent_menu'><i class="fa fa-refresh" aria-hidden="true"></i> Update Menu</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modalToggle" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /List Menubar content -->
</template>
<script>
	export default{
        name: 'Menubar',
        data(){
			return{
                menus:{},
                errors:{},
                update_errors:{},
                child_errors:{},
                menu: {
                    name: '',
                    url: '',
                    parent_id: '',
                    sort_order: '',
                    is_active: 1,
                },
                parent_name:'',
                parent_key:'',
                chlid_key:'',
                childmenus:{},
                editable_parent_menu_info:{},
                child_form_add:false,
                editable_child_menu_info:{},
                modalShow: false
            }
        },
		mounted(){
			axios.post('getMenu')
			.then((response)=> this.menus = response.data)
            .catch((error) => this.errors = error.response.data.errors);
        },
        methods: {
            modalToggle(){
                this.modalShow = !this.modalShow
            },
            add_menu(){
                axios.post('/admin/menubar',this.$data.menu)
                .then((response)=> {
                    if(this.menu.parent_id > 0){
                        this.$data.menu.name='',
                        this.$data.menu.url='',
                        this.$data.menu.parent_id='',
                        this.$data.menu.sort_order=''
                    }
                    else{
                        this.menus.push(response.data)
                        this.$data.menu.name='',
                        this.$data.menu.url='',
                        this.$data.menu.sort_order=''
                    }

                })
                .catch((error)=> this.errors = error.response.data.errors);
            },
            showChildMenu(parent_menu_id,parent_menu_name){
                axios.get('/admin/menubar/'+parent_menu_id)
                .then((response)=> this.childmenus = response.data)
                .catch((error)=> console.log(error));
                this.parent_name = parent_menu_name;
            },
            editParentMenu(key,parent_menu_id,parent_menu_name){
                axios.get('/admin/menubar/'+parent_menu_id+'/edit')
                .then((response)=> this.editable_parent_menu_info = response.data[0])
                .catch((error)=> console.log(error.response.data));
                this.parent_name = parent_menu_name;
                this.parent_key = key;
                //console.log(this.editable_parent_menu_info);
                this.modalShow = !this.modalShow
            },
            update_parent_menu(){
                axios.patch('/admin/menubar/'+this.editable_parent_menu_info.id,this.$data.editable_parent_menu_info)
                .then((response)=> {
                    this.modalShow = !this.modalShow
                    this.menus.splice(this.parent_key,1,response.data)
                })
                .catch((error)=> this.update_errors = error.response.data.errors);
            },
            childMenuEdit(key,childmenuID){
                axios.get('editClildmenu/'+childmenuID)
                .then((response)=> this.editable_child_menu_info = response.data[0])
                .catch((error)=> console.log(error))
                this.child_form_add = true
                this.chlid_key = key
            },
            updateChildMenu(){
                axios.patch('/admin/menubar/'+this.editable_child_menu_info.id,this.$data.editable_child_menu_info)
                .then((response)=> {
                    this.child_errors =''
                    this.editable_child_menu_info =''
                    this.child_form_add = false
                    this.childmenus.splice(this.chlid_key,1,response.data)
                })
                .catch((error)=> this.child_errors = error.response.data.errors);
            },
            deleteParentMenu(key,parent_id){
                if(confirm("Are you sure ?")){
                    axios.delete('/admin/menubar/'+parent_id)
                    .then((response)=> {
                        if(response.data.success){
                            console.log(response.data.success)
                            this.menus.splice(key,1);
                            swal({
                            type: 'success',
                            title: 'Menu delete successfully !',
                            showConfirmButton: false,
                            timer: 1500
                            })
                        }else {
                            console.log(response.data.error)
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: "You can't delete before deleting this sub-menu !",
                            })
                        }
                    })
                    .catch((error)=> {
                        this.errors = error.response.data.errors;
                    });
                }
            },
            childMenuDelete(key,childMenuId){
                if(confirm("Are you sure ?")){
                    axios.delete('/childmenudelete/'+childMenuId)
                    .then((response)=> {
                        console.log(response.data)
                        this.childmenus.splice(key,1);
                        swal({
                        type: 'success',
                        title: 'Sub-menu delete successfully !',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    })
                    .catch((error)=> {
                        this.errors = error.response.data.errors;
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: "Sub-menu delate failed !",
                        })
                    });
                }
            }
        },
        computed: {
            myStyle(){
                if(this.modalShow){
                    return {
                        display:'block'
                    }
                }
            }
        }
	}
</script>

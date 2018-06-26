<template>
    <!-- Banner section content -->
    <div class="wrapper">
        <div class="page-header page-header-default">
            <div class="container-fluid">
                <div class="add-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" :class="{'has-error':errors.title}">
                                <label class="control-label" for="banner_title">Banner Title</label>
                                <input type="text" class="form-control" id="banner_title" placeholder="Banner Title" v-model="banner.title">
                                <small v-if="errors.title" class="text-danger">{{ errors.title[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" :class="{'has-error':errors.desc}">
                                <label class="control-label" for="banner_desc">Banner Description</label>
                                <textarea class="form-control" id="banner_desc" rows="5" v-model="banner.desc" placeholder="Banner Description"></textarea>
                                <small v-if="errors.desc" class="text-danger">{{ errors.desc[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" :class="{'has-error':errors.url}">
                                <label class="control-label" for="video_url">Banner Video URL</label>
                                <input type="text" class="form-control" id="video_url" placeholder="Banner Video URL" v-model="banner.url">
                                <small v-if="errors.url" class="text-danger">{{ errors.url[0] }}</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <button type="button" class="primary-btn" @click='add_banner_item'><i class="fa fa-plus" aria-hidden="true"></i> Add Banner Item</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Banner Title</th>
                            <th>Banner Desciption</th>
                            <th>Banner Video URL</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(banner,key) in banners" :key="banner.key">
                            <td>{{ key+1 }}</td>
                            <td>{{ banner.title }}</td>
                            <td>{{ banner.desc | truncate(100) }}</td>
                            <td>{{ banner.url }}</td>
                            <td><a @click="edit_banner_item(key,banner.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td><a @click="delete_banner_item(key,banner.id)"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Show child menu Modal -->
        <div class="modal fade" :class="{in: modalShow}" tabindex="-1" :style="modalStyle">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" @click="modalToggle()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> Edit-Banner</h4>
                </div>
                <div class="modal-body">
                    <div class="add-form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" :class="{'has-error':update_errors.title}">
                                    <label class="control-label" for="edit_banner_title">Banner Title</label>
                                    <input type="text" class="form-control" id="edit_banner_title" placeholder="Banner Title" v-model="edit_banner.title">
                                    <small v-if="update_errors.title" class="text-danger">{{ update_errors.title[0] }}</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" :class="{'has-error':update_errors.desc}">
                                    <label class="control-label" for="edit_banner_desc">Banner Description</label>
                                    <textarea class="form-control" rows="5" id="edit_banner_desc" placeholder="Banner Description" v-model="edit_banner.desc"></textarea>
                                    <small v-if="update_errors.desc" class="text-danger">{{ update_errors.desc[0] }}</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" :class="{'has-error':update_errors.url}">
                                    <label class="control-label" for="edit_banner_video_url">Banner Video URL</label>
                                    <input type="text" class="form-control" id="edit_banner_video_url" placeholder="Banner Video URL" v-model="edit_banner.url">
                                    <small v-if="update_errors.url" class="text-danger">{{ update_errors.url[0] }}</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="button" class="primary-btn" @click='update_banner_item(edit_banner.id)'><i class="fa fa-refresh" aria-hidden="true"></i> Update Banner Item</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modalToggle()">Close</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Banner section content -->
</template>
<script>
	export default{
        name: 'Banner',
        data(){
			return{
                banners:{},
                errors:{},
                update_errors:{},
                banner:{
                    title: '',
                    desc: '',
                    url: '',
                },
                edit_banner:{},
                modalShow: false,
                edit_banner_key: '',
            }
        },
		mounted(){
            axios.post('getBanner')
			.then((response)=> this.banners = response.data)
            .catch((error) => this.errors = error.response.data.errors);
        },
        methods: {
            add_banner_item(){
                axios.post('banner',this.$data.banner)
                .then(response=> {
                    if(response.data.error){
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: response.data.error,
                        })
                    }else{
                        this.banners.push(response.data)
                        this.$data.banner.title='',
                        this.$data.banner.desc='',
                        this.$data.banner.url=''
                    }
                })
                .catch((error)=> this.errors = error.response.data.errors);
            },
            modalToggle(){
                this.modalShow = !this.modalShow
            },
            edit_banner_item(key,bannerId){
                this.modalShow = !this.modalShow
                this.edit_banner_key = key
                axios.get('banner/'+bannerId+'/edit')
                .then((response)=> {
                    this.edit_banner = response.data[0]
                })
                .catch((error)=> console.log(error.response.data));
            },
            update_banner_item(bannerId){
                axios.patch('/admin/banner/'+bannerId,this.$data.edit_banner)
                .then((response)=> {
                    this.modalShow = !this.modalShow
                    this.banners.splice(this.edit_banner_key,1,response.data)
                })
                .catch((error)=> this.update_errors = error.response.data.errors);
            },
            delete_banner_item(key,bannerId){
                if(confirm("Are you sure ?")){
                    axios.delete('banner/'+bannerId)
                    .then((response)=> {
                        console.log(response.data)
                        this.banners.splice(key,1);
                        swal({
                        type: 'success',
                        title: 'Banner delete successfully !',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    })
                    .catch((error)=> {
                        this.errors = error.response.data.errors;
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: "Banner delate failed !",
                        })
                    });
                }
            },
        },
        computed: {
            modalStyle(){
                if(this.modalShow){
                    return {
                        display:'block'
                    }
                }
            }
        }
	}
</script>

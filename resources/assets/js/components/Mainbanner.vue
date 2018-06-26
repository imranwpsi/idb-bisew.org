<template>
    <div class="banner-section">
            <div id="main-top">
                <div id="bg">
                    <div class="container">
                        <div class="row" v-for="banner in banners" :key="banner.id">
                            <div class="col-md-7">
                                <div class="idb-welcome">
                                <h3>{{ banner.title }}</h3>
                                    <p>{{ banner.desc }}</p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="embaded-video">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" :src="banner.url" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="btm-curve"><img src="public_assets/img/btm.png" width="204" height="38"></div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                banners:{},
                errors:{},
            }
        },
        mounted(){
            axios.post('admin/getBanner')
			.then((response)=> {
                this.banners = response.data
            })
			.catch((error) => this.errors = error.response.data.errors)
        }
    }
</script>

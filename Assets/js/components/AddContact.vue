<template>
    <div>
        <el-button type="success" size="small" class="new-folder" @click="dialogFormVisible = true" icon="el-icon-plus">
        </el-button>
        <el-dialog :title="trans('Create Contact')" :visible.sync="dialogFormVisible" width="30%">
            <el-form :model="contact" v-loading.body="loading" @submit.native.prevent="onSubmit()">
                <el-row>
                    <el-col :span="12">                
                        <el-form-item :label="trans('First Name')" :class="{'el-form-item is-error': form.errors.has('first_name') }">
                            <el-input v-model="contact.first_name" required="" name="first_name" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('first_name')"
                                 v-text="form.errors.first('first_name')"></div>
                        </el-form-item>
                    </el-col>    
                    <el-col :span="12">
                        <el-form-item :label="trans('Last Name')" :class="{'el-form-item is-error': form.errors.has('last_name') }">
                            <el-input v-model="contact.last_name" required="" name="last_name" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('last_name')"
                                 v-text="form.errors.first('last_name')"></div>
                        </el-form-item> 
                    </el-col>                   
                </el-row>
                <el-row>
                    <el-col :span="12">                
                        <el-form-item :label="trans('Phone')" :class="{'el-form-item is-error': form.errors.has('phone') }">
                            <el-input v-model.number="contact.phone" required="" name="phone" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('phone')"
                                 v-text="form.errors.first('phone')"></div>
                        </el-form-item>
                    </el-col>
                </el-row>   
            </el-form>
            <span slot="footer" class="dialog-footer">
                <el-button @click="closeDialog">{{ trans('core.button.cancel') }}</el-button>
                <el-button type="primary" @click="onSubmit('numberValidateForm')">{{ trans('core.confirm') }}</el-button>
            </span>
        </el-dialog>

    </div>
</template>

<script>
    import Form from 'form-backend-validation';

    export default {
        props: ['user_type'],
        data() {
            return {
                dialogFormVisible: false,
                contact: {
                    first_name: '',
                    last_name: '',                    
                    phone: '',
                },
                form: new Form(),
                loading: false,
            };
        },
        methods: {
            onSubmit() {
                this.form = new Form(_.merge(this.contact, { user_type: this.user_type }));
                this.loading = true;
                this.form.post(route('api.contact.contacts.store'))
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                        this.dialogFormVisible = false;
                        this.contact.first_name = '';
                        this.contact.last_name = '';                        
                        this.$events.emit('ContactWasCreated', response.data);
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                        this.$notify.error({
                            title: 'Error',
                            message: 'There are some errors in the form.',
                        });
                    });
            },
            closeDialog() {
                this.form.clear();
                this.dialogFormVisible = false;
            },
        },
        mounted() {
        },
    };
</script>
<style>
    .new-folder {
        float: left;
        margin-right: 10px;
    }
</style>

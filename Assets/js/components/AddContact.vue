<template>
    <div>
        <el-button type="success" size="small" class="new-folder" @click="dialogFormVisible = true" icon="el-icon-plus">
        </el-button>
        <el-dialog :title="trans('Create Contact')" :visible.sync="dialogFormVisible" width="30%" >
            <el-form :model="contact" :rules="rules" ref="ruleForm" v-loading.body="loading" @submit.native.prevent="onSubmit()" class="demo-ruleForm">
                <el-row>
                    <el-col :span="12">                
                        <el-form-item :label="trans('First Name')" :class="{'el-form-item is-error': form.errors.has('first_name') }" prop="first_name">
                            <el-input v-model="contact.first_name" name="first_name" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('first_name')"
                                 v-text="form.errors.first('first_name')"></div>
                        </el-form-item>
                    </el-col>    
                    <el-col :span="12">
                        <el-form-item :label="trans('Last Name')" :class="{'el-form-item is-error': form.errors.has('last_name') }" prop="last_name">
                            <el-input v-model="contact.last_name"  name="last_name" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('last_name')"
                                 v-text="form.errors.first('last_name')"></div>
                        </el-form-item> 
                    </el-col>                   
                </el-row>
                <el-row>
                    <el-col :span="12">                
                        <el-form-item :label="trans('Phone')" :class="{'el-form-item is-error': form.errors.has('phone') }" prop="phone">
                            <el-input v-model="contact.phone"  name="phone" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('phone')"
                                 v-text="form.errors.first('phone')"></div>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item :label="trans('Email')" :class="{'el-form-item is-error': form.errors.has('email') }">
                            <el-input type="email" v-model="contact.email" name="email" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('email')"
                                 v-text="form.errors.first('email')"></div>
                        </el-form-item> 
                    </el-col>                                       
                </el-row>   
                <el-row>
                    <el-col :span="12">                
                        <el-form-item :label="trans('Company Name')" :class="{'el-form-item is-error': form.errors.has('company_name') }">
                            <el-input v-model="contact.company_name" name="company_name" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('company_name')"
                                 v-text="form.errors.first('company_name')"></div>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">                
                        <el-form-item :label="trans('GSTIN')" :class="{'el-form-item is-error': form.errors.has('gstin') }">
                            <el-input v-model="contact.gstin" name="gstin" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('gstin')"
                                 v-text="form.errors.first('gstin')"></div>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>                
                    <el-col :span="12">                                    
                        <el-form-item :label="trans('CITY')" :class="{'el-form-item is-error': form.errors.has('city') }">
                            <el-input v-model="contact.city" name="city" auto-complete="off" autofocus></el-input>
                            <div class="el-form-item__error" v-if="form.errors.has('city')"
                                 v-text="form.errors.first('city')"></div>
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
                    email: '',
                    gstin: '',
                    company_name: '',
                    city:'',
                },
                form: new Form(),
                loading: false,
                rules: {
                first_name: [
                        { required: true, message: 'enter first name', trigger: 'blur' }
                    ],
                last_name: [
                        { required: true, message: 'enter last name', trigger: 'blur' }
                    ],
                phone: [
                        { required: true, message: 'enter mobile number', trigger: 'blur' },
                        { min: 10, message: 'Enter valid mobile number', trigger: 'blur' }                        
                    ]                                        
                },
                company_name: [
                    { 
                        min: 3, 
                        message: 'Enter the company name with minimum of 3 character.', 
                        trigger: 'blur'
                    }
                ]
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
                        this.contact.phone = '';
                        this.contact.email = '';
                        this.contact.gstin = '';
                        this.contact.company_name = '';
                        this.contact.city = '';
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

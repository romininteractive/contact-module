<template>
<el-row class="demo-autocomplete">
  <el-col :span="15">
    <el-autocomplete
      class="inline-input"
      v-model="state2"
      size="medium"
      required=""
      value-key="full_name_phone"
      name="cid"
      :fetch-suggestions="querySearch"
      placeholder="Please Input"
      @select="handleSelect"
    ></el-autocomplete>
    <input type="hidden" name="customer_id" v-model="selected_customer" />
  </el-col>
  &nbsp;&nbsp;
  <el-col :span="3">
    <add-contact parent-id="first_name" :user_type="user_type"></add-contact>           
  </el-col>  
</el-row>
</template>
<script>
  export default {
    data() {
      return {
        links: [],
        state2: '',
        selected_customer: null,
      };
    },
    props: ['value','name','user_type'],
    methods: {
      querySearch(queryString, cb) {
      // console.log(cb);
        var links = this.links;
        var results = queryString ? links.filter(this.createFilter(queryString)) : links;
        // call callback function to return suggestions
        cb(results);
      },
      createFilter(queryString) {
        return (link) => {
          return (link.full_name_phone.toLowerCase().indexOf(queryString.toLowerCase()) !== -1);
        };
      },
      loadAll() {
          let that = this;
          axios.get('/api/contact/contacts?type='+that.user_type).then((response) => {
            // for(var i )
            that.links = response.data;
            // that.state2 = response.data.contact_id;
          }).catch( error => { console.log(error); });

        this.$events.listen('ContactWasCreated', (eventData) => {
            that.state2 = eventData.full_name_phone;
            that.links.push(eventData);
            that.selected_customer = eventData.id;
        });                
      },
      handleSelect(item) {
        // console.log(item);
        this.selected_customer = item.id;
      }
    },
    mounted() {
      this.loadAll();
      this.state2 = this.name;
      this.selected_customer = this.value;

    }
  }
</script>
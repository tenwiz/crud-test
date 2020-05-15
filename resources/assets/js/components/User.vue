<template>
    <div class="user">
        <div class="col-2">
            <h3>Name: {{ name | properCase }}</h3>
            <h3>Email: {{ email }}</h3>
            <select @change="update">
                <option
                        v-for="col in [ 'sample1@email.com', 'company@company.com', 'user@user.com' ]"
                        :value="col"
                        :key="col"
                        :selected="col === email ? 'selected' : ''"
                >{{ col | properCase }}</option>

            </select>
            <button @click="del">Delete</button>
        </div>
    </div>
</template>
<script>
  export default {
    methods: {
      update(val) {
        this.$emit('update', this.id, val.target.selectedOptions[0].value);
      },
      del() {
        this.$emit('delete', this.id);
      }
    },
    props: ['id', 'password', 'name', 'email'],
    filters: {
      properCase(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    }
  }
</script>
<style>
    .user {
        display: flex;
        margin: 1em 1em 1em 0;
        border: 1px solid #d1d1d1;
        padding: 1em;
        max-width: 350px;
        background-color: white;
    }

    .col-2 {
        margin-left: 1em;
    }

    .col-2 > h3 {
        margin: 0.5em 0;
    }
</style>

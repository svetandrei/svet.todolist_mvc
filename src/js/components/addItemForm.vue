<template>
  <div class="input-group mb-3">
    <input type="text" class="form-control"
           id="todo-input"
           placeholder="Add new task"
           required
           v-model="item.title">
    <button class="btn btn-primary" :class="[item.title ? 'active' : 'btn-secondary']"
            @click="addItem()">
      Add
    </button>
  </div>
</template>
<script>
const axios = require("axios");

import {Utility} from "../utility";

export default {
  components: {
    app
  },
  data: function() {
    return {
      item: {
        title: "",
      },
      utility: new Utility()
    };
  },
  methods: {
    addItem() {
      if (this.item.title === "") {
        return;
      }
      let data = new FormData();
      data.append('title', this.item.title);
      axios
        .post("/task/add", data)
        .then(res => {
          if (res.status === 200) {
            if (res.data.status === 'error') {
              this.utility.error(res.data.message);
              return;
            }
            this.item.title = "";
            this.$emit("reloadlist");
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

<style scoped>
.active {
  color: white;
  background-color: blue;
}
.inactive {
  color: gray;
}
</style>

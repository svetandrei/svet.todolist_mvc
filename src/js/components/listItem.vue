<template>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <input type="text" class="form-control me-3" :class="[this.task.edit ? '':'form-control-plaintext']"
           :disabled="!this.task.edit" v-model="this.task.input">
    <div class="btn-group col-auto">
      <button class="btn btn-primary btn-sm edit-btn" @click="[this.task.edit ? updateTask() : editTask($event)]"><i class="bi bi-pencil-square"></i></button>
      <button class="btn btn-danger btn-sm delete-btn" @click="removeItem()"><i class="bi bi-x-circle"></i></button>
    </div>
  </li>
</template>

<script>
const axios = require("axios");

import {Utility} from "../utility";

export default {
  props: ["item"],
  data: function() {
    return {
      task: {
        input: this.item.title,
        edit: false,
        btnEdit: '',
      },
      utility: new Utility()
    };
  },
  methods: {
    editTask(event) {
      this.task.btnEdit = event.target;
      this.task.edit = true;
      if (!event.target.classList.contains('edit-btn')) {
        this.task.btnEdit = event.target.parentElement;
      }
      this.task.btnEdit.className = 'btn btn-success btn-sm edit-btn';
      this.task.btnEdit.querySelector('i.bi').className = 'bi bi-check2-circle';
    },
    updateTask() {
      let data = new FormData();
      data.append('_method', 'patch')
      data.append('title', this.task.input);
      axios
        .post(`task/update/${this.item.id}`, data)
        .then(res => {
          if (res.status === 200) {
            if (res.data.status === 'error') {
              this.utility.error(res.data.message);
              return;
            }
            this.$emit("itemchanged");
            this.task.edit = false;
            this.task.btnEdit.className = 'btn btn-primary btn-sm edit-btn';
            this.task.btnEdit.querySelector('i.bi').className = 'bi bi-pencil-square'
          }
        })
        .catch(error => {
          console.log("Error", errors);
        });
    },
    removeItem() {
      axios
        .delete(`/task/delete/${this.item.id}`)
        .then(res => {
          if (res.status === 200) {
            if (res.data.status === 'error') {
              this.utility.error(res.data.message);
              return;
            }
            this.$emit("itemchanged");
          }
        })
        .catch(error => {
          console.log("Error", error);
        });
    }
  }
};
</script>
<style>
.form-control:disabled {
  background: transparent;
}
</style>

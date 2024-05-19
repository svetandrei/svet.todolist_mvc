<template>
  <ul class="list-group" id="todo-list">
    <list-item
      :item="item"
      v-on:itemchanged="$emit('reloadlist')"
      v-for="item in items"
      :key="item.id"
    />
  </ul>
</template>

<script>
import listItem from "./listItem.vue";

export default {
  components: {
    listItem
  },
  props: ["items"]
};
</script>

<style scoped></style>

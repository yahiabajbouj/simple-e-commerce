<template>
  <div class="grey">
    <v-container>
      <v-row>
        <v-col lg="6" offset="3" class="d-flex justify-center">
          <v-btn
            class="white black--text mx-3"
            v-for="tab in tabs"
            :to="tab.route"
            :key="tab.name"
            text
            color="#fff"
            exact
          >
            {{ tab.name }}
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tabs: [
        { name: "Products", route: "/product" },
        { name: "Orders", route: "/order" },
      ],
    };
  },
};
</script>
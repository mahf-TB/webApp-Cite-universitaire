<template>
  <div class="container">
    <h1 class="text-xxl text-[#2b6b88]">Bienvenu dans evenement</h1>
    <!-- Button trigger modal -->
    <pre>efezfez{{ auth_user }}</pre>
  </div>
</template>

<script>

export default {
  name: 'Evenement',
  components: {

  },
   props: {
    auth_user: Array
  },
  data() {
    return {
      selectedFiles: [],
    }
  },
  methods: {
   
  },

}
</script>

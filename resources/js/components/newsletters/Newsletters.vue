<template>
    <span>
        <h1>Secció Mailchimp</h1>
        <ul>
            <li><a href="https://mailchimp.com/">https://mailchimp.com/</a></li>
            <li>Usuari: npontcastells@gmail.com</li>
            <li><a href="https://us20.admin.mailchimp.com/lists/">https://us20.admin.mailchimp.com/lists/</a></li>
            <li>Nom de la llista: JOLIO</li>
            <li>Id de la llista: Vegeu .env file</li>
        </ul>
        <h2>Subscripció</h2>
        <h3>Membres:</h3>
        <ul>
            <li v-for="member in newsletter.members" v-text="member.email_address"></li>
        </ul>
    </span>
</template>

<script>
  export default {
    name: 'Newsletters',
    props: {
      newsletter: {
        required: true
      }
    }
  }
</script>

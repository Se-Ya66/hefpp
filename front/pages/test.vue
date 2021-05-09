<template>
    <div>
        <v-text-field 
        :rules="[rules.counter3]"
        maxlength="300"
        counter
        v-model="word"
        />
        <p>{{word}}</p>
        <button @click="check">click</button>
    </div>
</template>

<script>

export default {
    data(){
        return{
            rules: {
                required: value => !!value || ' 必須項目です',
                counter: value => value.length >= 3 || '3文字以上で指定してください',
                counter2: value => value.length >= 8 || '8文字以上で指定してください',
                counter3: value => value.length <= 300 || '300文字以上で指定してください',
                email: value => {
                    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    return pattern.test(value) || '有効なメールアドレスを指定してください'
                },
            },
            word:''
        }
    },
    created () {

    },
    methods: {
        check(){
            console.log(this.word);
        }
    },
    computed:{
        
        
        
    },
    
}
</script>

<style lang="scss">

</style>
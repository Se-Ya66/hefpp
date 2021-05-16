<<template>
    <div class="test-wrapper">
        <v-container>
            <div 
            v-for="(list, key) in displayLists"
            :key="key"
            class="test-inner"
            >
                <p>{{list.title}}</p>
                <p>{{list.text}}</p>
            </div>
            <v-pagination
            v-model="page"
            :length="length"
            @input = "pageChange"
            ></v-pagination>
        </v-container>
    </div>
</template>

<script>

export default {
    data(){
        return{
            page:1,
            length:0,
            lists:[
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
                {
                    title:'title',
                    text:'text'
                },
            ],
            displayLists:[],
            pageSize: 5,
        }
    },
    methods:{
        pageChange: function(pageNumber){
            this.displayLists = this.lists.slice(this.pageSize*(pageNumber -1), this.pageSize*(pageNumber));
        }
    },
    created(){
        this.length = Math.ceil(this.lists.length/this.pageSize);

        this.displayLists = this.lists.slice(this.pageSize*(this.page -1), this.pageSize*(this.page));
    }
}
</script>

<style lang="scss">
.test-wrapper{
    width:100%;
    .test-inner{
        
        text-align: center;
    }
}
</style>
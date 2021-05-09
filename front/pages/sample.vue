<template>
    <div>
        <v-container>
            <span>検索条件</span>
            <v-text-field 
            label="キーワードで検索" 
            color="indigo" 
            v-model="keyword"
            clearable
            />
            <button class="btn1">検索</button>
            <div class="checkbox-wrapper mb-4">
                <span>種別</span>
                <v-checkbox
                label="生産"
                value="生産"
                color="indigo"
                v-model="showProduction"
                ></v-checkbox>
                <v-checkbox
                label="加工"
                value="加工"
                color="indigo"
                v-model="showProcessing"
                ></v-checkbox>
                
            </div>
            <div class="checkbox-wrapper">
                <span class="mb-2">地域</span>
                <v-autocomplete
                :items="items"
                color="indigo"
                outlined
                small-chips
                deletable-chips
                clearable
                v-model="showPrefecture"
                ></v-autocomplete>
            </div>
            <button @click="setList">click</button>
            <div v-for="(article, id) in result" :key="id" class="box">
                <span>{{article.title}}</span>
                <span>{{article.body}}</span>
                <span>{{article.type}}</span>
                <span>{{article.prefecture}}</span>
            </div>
        </v-container>
    </div>
</template>

<script>

export default {
    data(){
        return{
            keyword:'',
            showPrefecture: '',
            showProduction:'',
            showProcessing:'',
            items:[
                '北海道',
                '青森',
                '岩手',
                '宮城',
                '秋田',
                '山形',
                '福島',
                "茨城",
                "栃木",
                "群馬",
                "埼玉",
                "千葉",
                "東京",
                "神奈川",
                "新潟",
                "富山",
                "石川",
                "福井",
                "山梨",
                "長野",
                "岐阜",
                "静岡",
                "愛知",
                "三重",
                "滋賀",
                "京都",
                "大阪",
                "兵庫",
                "奈良",
                "和歌山",
                "鳥取",
                "島根",
                "岡山",
                "広島",
                "山口",
                "徳島",
                "香川",
                "愛媛",
                "高知",
                "福岡",
                "佐賀",
                "長崎",
                "熊本",
                "大分",
                "宮崎",
                "鹿児島",
                "沖縄"
            ],
            articles:[
                {
                    id:1,
                    prefecture:'愛知',
                    body:'テストテストテスト',
                    title:'テスト',
                    type:'生産',
                },
                {
                    id:2,
                    prefecture:'岐阜',
                    body:'テストテストテスト',
                    title:'テスト',
                    type:'加工',
                },
                {
                    id:3,
                    prefecture:'三重',
                    body:'ダミーダミーダミー',
                    title:'ダミー',
                    type:'生産',
                },
                {
                    id:4,
                    prefecture:'三重',
                    body:'ダミーダミーダミー',
                    title:'テスト',
                    type:'加工',
                },
            ],
            result:[]
        }
    },
    computed:{
        // filteredList() {

        // },
    },
    methods:{
        setList(keyword, showProcessing, showProduction, prefecture){
            // if(keyword ){
            //     this.result = this.articles.filter(
                
            //     article => article.body === keyword &&
                            

            // );
            // }
            // this.result = this.articles.filter(
                
            //     article => article.body === keyword &&
            //                 article.type === showProcessing &&
            //                 article.type === showProduction &&
            //                 article.prefecture === prefecture 

            // );
            // let newList = [];  
            // for(let i=0; i<this.articles.length; i++){
            //     let isShow = false;
            //     if (this.showProcessing && this.showProduction) {
            //         return
            //     }
            //     if (this.showProduction && this.articles[i].type == "生産") {
            //         isShow = true;
            //     }
            //     if (this.showProcessing && this.articles[i].type == "加工") {
            //         isShow = true;
            //     }
                
            //     if (this.showPrefecture) {
            //         if (this.showPrefecture == this.articles[i].prefecture) {
            //             isShow = true;
            //         } else {
            //             isShow = false
            //         }
            //     }
    
            //     if (this.keyword) {
            //         if (this.keyword == this.articles[i].title) {
            //             isShow = true;
            //         } else if(this.keyword == this.articles[i].body) {
            //             isShow = true;
            //         }else if(this.keyword == this.articles[i].type) {
            //             isShow = true;
            //         }else if(this.keyword == this.articles[i].prefecture) {
            //             isShow = true;
            //         }else{
            //             isShow = false
            //         }
            //     }
                    
            //     if (isShow) {
            //         newList.push(this.articles[i]);
            //     }
            // }
            // this.result = newList;

        },
        wordSearch(){
            
        }
    },
    created(){
        this.result = this.articles;
    }
}
</script>

<style lang="scss">
.box{
    border:apx solid black;
}
.btn1{
    border:1px solid black;
    width:100px;
    height:30px;
}
</style>
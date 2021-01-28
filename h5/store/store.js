import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);



export const store = new Vuex.Store({
	state: {
		user_status:{
			open_id: '',
			is_auth:1,
			session_key:'',
		},
		user:{
			avatarUrl:'',
			nickName:'',
			gender:1,
			sign_desc:'',
		}
		
	},
	mutations: {
		set_user_status(state,{open_id,is_auth,session_key}){
			if(open_id){
				state.user_status.open_id = open_id;
			}
			if(is_auth !== undefined){
				state.user_status.is_auth = is_auth;
			}
			if(session_key){
				state.user_status.session_key = session_key;
			}
		},
		set_user(state,{avatarUrl,nickName,gender,sign_desc}){
			if(avatarUrl){
				state.user.avatarUrl = avatarUrl;
			}
			if(nickName){
				state.user.nickName = nickName;
			}
			if(gender){
				state.user.gender = gender;
			}
			
			if(sign_desc){
				state.user.sign_desc = sign_desc;
			}
		},
	}
});

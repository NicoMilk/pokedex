
import createPersistedState from "vuex-persistedstate";

const url = "https://graph.microsoft.com/beta";

var headers = new Headers();
headers.append("Content-Type","application/json");
//console.log(headers.get)

const status = response => (response.status >= 200 && response.status < 300) ? Promise.resolve(response) : Promise.reject((response.statusText));



export default {

  state: {
    teams : [],
    currentTeamIndex: 0,
    currentChannelIndex: 0,
    channels: [],
    messages: [],
    currentMessageId : '',
    replies:[],
    accessToken : undefined,
    isAuth : false
  },
  
  mutations: {
    setTeams(state, teams) {
      state.teams = teams;
    },
    setCurrentTeamIndex(state, team_idx) {
      state.currentTeamIndex = team_idx;
    },
    setCurrentChannelIndex(state, channel_idx) {
      state.currentChannelIndex = channel_idx;
    },
    setChannels(state, channels) {
      let general = channels.find(el => el.displayName=="General");
      let generalIdx = channels.findIndex(el => el.displayName=="General");
      channels.splice(generalIdx,1);
      channels.sort((a, b) => ( a.displayName > b.displayName) ? 1 : -1)
      channels.unshift(general)
      state.channels = channels;
    },
    setMessages(state, messages) {
      state.messages = messages.reverse();
    },
    setReplies(state, payload) {
      console.log(payload)
      let messageIndex = state.messages.findIndex(item => item.id==payload.message_id);
      console.log(messageIndex)
      state.messages[messageIndex].replies = payload.replies.reverse();
    },
    setCurrentMessageId(state,message_id) {
      state.currentMessageId =  message_id;
    },
    setAccessToken(state,accessToken) {
      state.accessToken = accessToken;
      this.dispatch("getTeams");
    },
    setIsAuth(state,isAuth) {
      state.isAuth = isAuth;
    },
    doReplies(state,payload) {
      let message = payload.message;
      message.replies=payload.replies;
      state.messages.push(payload.message)
    }
  },

  actions: {    

    async getTeams(state) {

      const teamsRaw = await fetch(url+"/me/memberOf", { headers: { 
        "Content-Type": "application/json",
        "Authorization": "Bearer " + this.getters.getAccessToken
      }  
    });

      const validTeams = await status(teamsRaw).catch(
        (err) => {
          console.log(err)
          if (err == "Unauthorized") state.commit("setIsAuth", false);
          return false;
        })

      if (validTeams) {
        state.commit("setIsAuth", true);
        const teams = await validTeams.json();
        state.commit("setTeams", teams.value );
      }
    },

    /* async getTeam(state, team_idx) {

      headers.append('Authorization', 'Bearer ' + state.accessToken)
      const teamRaw = await fetch(url+"/teams/" + team_idx, { headers: { 
        "Content-Type": "application/json",
        "Authorization": "Bearer " + this.getters.getAccessToken
      }  });
      const team = await teamRaw.json();
      state.commit("setCurrentTeamIndex", team_idx );
    }, */

    async getChannels(state, team_idx) {

      state.commit("setCurrentTeamIndex", team_idx );
      const channelsRaw = await fetch(url+"/teams/" + this.getters.getCurrentTeam.id + "/channels", { headers: { 
        "Content-Type": "application/json",
        "Authorization": "Bearer " + this.getters.getAccessToken
      }  });

      const validChannels = await status(channelsRaw).catch(
        (err) => {
          console.log(err)
          if (err == "Unauthorized") state.commit("setIsAuth", false);
          return false;
        })

      if (validChannels) {
        state.commit("setIsAuth", true);
        const channels = await validChannels.json();
        state.commit("setChannels", channels.value );
      }
    },

    async getMessages(state, channel_idx) {

      state.commit("setCurrentChannelIndex", channel_idx );

      const messagesRaw = await fetch(url+"/teams/" + this.getters.getCurrentTeam.id + "/channels/"+ this.getters.getCurrentChannel.id + "/messages", { headers: { 
        "Content-Type": "application/json",
        "Authorization": "Bearer " + this.getters.getAccessToken
      }  });

      const validMessages = await status(messagesRaw).catch(
        (err) => {
          console.log(err)
          if (err == "Unauthorized") state.commit("setIsAuth", false);
          return false;
        })

      if (validMessages) {
        state.commit("setIsAuth", true);
        const messages = await validMessages.json();
      
        state.commit("setMessages", [] );
        
        messages.value.reverse().forEach( (message) => {
          state.dispatch("setReplies", message);
        }); 

        //state.commit("setMessages", messages.value );

              
      }
    },


    async setReplies(state, message ) {

      const repliesRaw = await fetch(url+"/teams/" + this.getters.getCurrentTeam.id + "/channels/"+ this.getters.getCurrentChannel.id + "/messages/" + message.id + "/replies", { headers: { 
        "Content-Type": "application/json",
        "Authorization": "Bearer " + this.getters.getAccessToken
      }  });

      const validReplies = await status(repliesRaw).catch(
        (err) => {
          console.log(err)
          if (err == "Unauthorized") state.commit("setIsAuth", false);
          return false;
        })

      if (validReplies) {
        state.commit("setIsAuth", true);
        const replies = await validReplies.json();
        state.commit("doReplies", { message,  replies : replies.value.reverse() });
      }
    },

    async getReplies(state, message ) {

      const repliesRaw = await fetch(url+"/teams/" + this.getters.getCurrentTeam.id + "/channels/"+ this.getters.getCurrentChannel.id + "/messages/" + message.id + "/replies", { headers: { 
        "Content-Type": "application/json",
        "Authorization": "Bearer " + this.getters.getAccessToken
      }  });

      const validReplies = await status(repliesRaw).catch(
        (err) => {
          console.log(err)
          if (err == "Unauthorized") state.commit("setIsAuth", false);
          return false;
        })

      if (validReplies) {
        state.commit("setIsAuth", true);
        const replies = await validReplies.json();
        state.commit("setReplies", { message_id,  replies : replies.value });
      }
    }


  },

  modules: {
  },

  getters: {

    getTeams(state) {
      return state.teams;
    }, 
    getCurrentTeamIndex(state) {
      return state.currentTeamIndex;
    }, 
    getCurrentChannelIndex(state) {
      return state.currentChannelIndex;
    }, 
    getCurrentTeam(state) {
      return state.teams.length ? state.teams[state.currentTeamIndex] : '';
    }, 
    getCurrentChannel(state) {
      return state.channels.length ? state.channels[state.currentChannelIndex] : '';
    }, 
    getChannels(state) {
      return state.channels;
    }, 
    getMessages(state) {
      return state.messages;
    }, 
    getReplies(state) {
      let messageIndex = state.messages.findIndex(item => item.id==state.currentMessageId);
      console.log(messageIndex)
      return messageIndex != -1 ? state.messages[messageIndex].replies : [];
    }, 
    getAccessToken(state) {
      return state.accessToken;
    },
    isAuth(state) {
      return state.isAuth;
    } 
  },
  
  plugins: [createPersistedState()]
}

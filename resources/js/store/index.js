
import createPersistedState from "vuex-persistedstate";

const url = "http://localhost:8000/api/";

var headers = new Headers();
headers.append("Content-Type","application/json");

const status = response => (response.status >= 200 && response.status < 300) ? Promise.resolve(response) : Promise.reject((response.statusText));

// const apitoken = laravel =>  {
  
//   console.log(laravel);
//   return Promise.resolve(laravel.apiToken);
// }

// getApiToken(state) {
//   return window.Laravel.apiToken;
// }

export default {

  state: {
    poks : [],
    pok : {},
    myProfile : [],  //Nico
    myTeam : [], //Nico
  },
  
  mutations: {
    setPoks(state, poks) {
      state.poks = poks;
    },
    setPok(state, pok) {
      state.pok = pok;
    },

    setMyProfile(state, myProfile) {  //Nico
      state.myProfile = myProfile;
    },

    setMyTeam(state, myTeamPoks) {  //Nico
      state.myTeam = [];
      let teamPok = {};

      myTeamPoks.forEach(element => {
        teamPok = state.poks.find(pok => pok.id == element.pokemon_id)
      });
      state.myTeam.push(teamPok);
    },

  },

  actions: {    

    async getPoks(state) {

      const poksRaw = await fetch(url+"pokemons", { headers: { 
          "Content-Type": "application/json"
        }  
      });

      const validPoks = await status(poksRaw)

      const poks = await validPoks.json();

      state.commit("setPoks", poks.data );
      
    },

    async getPok(state, id) {

      const pokRaw = await fetch(url+"pokemons/"+id, { headers: { 
          "Content-Type": "application/json"
        }  
      });

      const validPok = await status(pokRaw)

      const pok = await validPok.json();

      state.commit("setPok", pok.data[0].Pokemon );
      
    },

    async myProfile(state) {  // GET profile for HeaderUser
      const myProfileRaw = await fetch(url+"users/me", 
      {
        method: 'GET',  
        headers: {
          Authorization: "Bearer ", // /!\ ACCESS TOKEN MISSING
          Accept: "application/json"}
      });

      const validMyProfile = await status(myProfileRaw);

      const myProfile = await validMyProfile.json();

      state.commit('setMyProfile', myProfile.user[0])
    },

    async myTeam(state) {  // GET current user's team
      const myTeamRaw = await fetch(url+"users/me/team", 
      {
        method: 'GET',  
        headers: {
          Authorization: "Bearer "+state.getters.getApiToken, // /!\ ACCESS TOKEN MISSING
          Accept: "application/json"}
      });

      const validMyTeam = await status(myTeamRaw);

      const myTeam = await validMyTeam.json();

      state.commit("setMyTeam", myTeam.team);
    },
  },
  
  
  modules: {
  },

  getters: {

    getPoks(state) {
      return state.poks;
    },

    getPok(state) {
      return state.pok;
    },

    getMyProfile(state) { // Nico
      return state.myProfile;
    },

    getMyTeam(state) { // Nico
      return state.myTeam;
    },

  },

  plugins: [createPersistedState()]
}

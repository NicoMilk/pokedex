
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
    evolPok : {},
    users :[],
    teams: [],
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
    setEvolPok(state, evolPok) {
      state.evolPok = evolPok;
    },
    setUsers(state, users){
      state.users=users;
     },
     setTeams(state,teams){
       state.teams=teams;
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

      if (pok.data[0].Pokemon.evolutions.evolution_id) state.dispatch("getEvolPok", pok.data[0].Pokemon.evolutions.evolution_id)
      
    },

    async getEvolPok(state, id) {

      const pokEvolRaw = await fetch(url+"pokemons/"+id, { headers: { 
          "Content-Type": "application/json"
        }  
      });

      const validEvolPok = await status(pokEvolRaw)

      const evolPok = await validEvolPok.json();

      state.commit("setEvolPok", evolPok.data[0].Pokemon );
      
    },
    async getUsers(state) {

      const usersRaw = await fetch(url+"users", { headers: { 
          "Content-Type": "application/json"
        }  
      });
     
      const validUsers = await status(usersRaw);

      const users = await validUsers.json();

      state.commit("setUsers", users.users );
      
    },
      async getTeams(state){

      let teams= [];

      for (let user of state.users)
      {
        const teamRaw = await fetch(url+"users/"+user.id+"/team" ,{ headers: { 
          "Content-Type": "application/json"
        }});

        const validTeam = await status(teamRaw);
        const team = await validTeam.json();
        teams.push('team');
      }

        state.commit("setTeams",teams.data);
    },

    async myProfile(state) {  // GET profile for HeaderUser
      const myProfileRaw = await fetch(url+"users/me", 
      {
        method: 'GET',  
        headers: {
          // Authorization: "Bearer ", // /!\ ACCESS TOKEN MISSING
          Authorization: "Bearer wpornjjNcP9uwwMSlj4XB1mAHtbu6ZRwwORhL7cifoSbSJfnE1xwodi9O6H6e3XUim42ipDA7MZyRf6obKluS1e8ncTydEGrKmiT",
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
          // Authorization: "Bearer "+state.getters.getApiToken, // /!\ ACCESS TOKEN MISSING
          Authorization: "Bearer wpornjjNcP9uwwMSlj4XB1mAHtbu6ZRwwORhL7cifoSbSJfnE1xwodi9O6H6e3XUim42ipDA7MZyRf6obKluS1e8ncTydEGrKmiT",
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
    getEvolPok(state) {
      return state.evolPok;
    },

    getUsers(state) {
      return state.users;
    },
    getTeams(state){
      return state.teams;
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

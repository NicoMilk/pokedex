import createPersistedState from "vuex-persistedstate";
import { forEach } from "lodash";

// const url = "https://localhost:8000/api/";
// const url = "https://pokedex-nc.herokuapp.com/api/";
// const url = process.env.MIX_APP_URL + "/api/";
const url = "/api/";

var headers = new Headers();
headers.append("Content-Type", "application/json");

const status = response =>
    response.status >= 200 && response.status < 300
        ? Promise.resolve(response)
        : Promise.reject(response.statusText);

export default {
    state: {
        poks: [],
        pok: {},
        evolPok: {},
        evolPok2: {},
        users: [],
        teams: [],
        myProfile: [], //Nico
        myUserProfile: {}, //Nico
        myTeam: [], //Nico
        apiToken: ""
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
        setEvolPok2(state, evolPok2) {
            state.evolPok2 = evolPok2;
        },
        setUsers(state, users) {
            state.users = users;
        },
        setUsersTeams(state, payload) {
            let user = payload.user;
            user.team = payload.team.team;
            state.users.push(user);
        },

        setMyProfile(state, myProfile) {
            //Nico
            state.myProfile = myProfile;
        },

        setMyTeam(state, myTeamPoks) {
            //Nico
            let team = [];

            myTeamPoks.forEach(element => {
                let teamPok = state.poks.find(
                    pok => pok.id == element.pokemon_id
                );
                team.push(teamPok);
            });
            state.myUserProfile = state.myProfile;
            state.myUserProfile.team = team;
        },

        setApiToken(state, apiToken) {
            state.apiToken = apiToken;
        }
    },

    actions: {
        async getPoks(state) {
            const poksRaw = await fetch(url + "pokemons", {
                headers: {
                    "Content-Type": "application/json"
                }
            });

            const validPoks = await status(poksRaw);

            const poks = await validPoks.json();

            state.commit("setPoks", poks.data);
        },

        async getPok(state, id) {
            const pokRaw = await fetch(url + "pokemons/" + id, {
                headers: {
                    Accept: "application/json",
                    "access-token": ""
                }
            });

            const validPok = await status(pokRaw);

            const pok = await validPok.json();

            state.commit("setPok", pok.data[0].Pokemon);

            if (pok.data[0].Pokemon.evolutions.evolution_id)
                state.dispatch(
                    "getEvolPok",
                    pok.data[0].Pokemon.evolutions.evolution_id
                );
        },

        async getEvolPok(state, id) {
            const pokEvolRaw = await fetch(url + "pokemons/" + id, {
                headers: {
                    Accept: "application/json"
                }
            });

            const validEvolPok = await status(pokEvolRaw);

            const evolPok = await validEvolPok.json();

            state.commit("setEvolPok", evolPok.data[0].Pokemon);

            if (evolPok.data[0].Pokemon.evolutions.evolution_id)
                state.dispatch(
                    "getEvolPok2",
                    evolPok.data[0].Pokemon.evolutions.evolution_id
                );
        },

        async getEvolPok2(state, id) {
            const pokEvolRaw2 = await fetch(url + "pokemons/" + id, {
                headers: {
                    "Content-Type": "application/json"
                }
            });

            const validEvolPok2 = await status(pokEvolRaw2);

            const evolPok2 = await validEvolPok2.json();

            state.commit("setEvolPok2", evolPok2.data[0].Pokemon);
        },
        async getUsers(state) {
            const usersRaw = await fetch(url + "users", {
                headers: {
                    Accept: "application/json",
                    Authorization: "Bearer " + state.getters.getApiToken
                }
            });

            const validUsers = await status(usersRaw);

            const users = await validUsers.json();

            state.commit("setUsers", []);

            users.users.forEach(user => {
                state.dispatch("getTeams", user);
            });
        },
        async getTeams(state, user) {
            const teamRaw = await fetch(
                url + "users/" + user.user_id + "/team",
                {
                    headers: {
                        Accept: "application/json",
                        Authorization: "Bearer " + state.getters.getApiToken
                    }
                }
            );

            const validTeam = await status(teamRaw);

            const team = await validTeam.json();

            state.commit("setUsersTeams", { user, team: team });
        },

        async myProfile(state) {
            // GET profile for HeaderUser
            const myProfileRaw = await fetch(url + "users/me", {
                method: "GET",
                headers: {
                    Authorization: "Bearer " + state.getters.getApiToken,
                    Accept: "application/json"
                }
            });

            const validMyProfile = await status(myProfileRaw);

            const myProfile = await validMyProfile.json();

            state.commit("setMyProfile", myProfile.user[0]);
        },

        async myTeam(state) {
            // GET current user's team
            const myTeamRaw = await fetch(url + "users/me/team", {
                method: "GET",
                headers: {
                    Authorization: "Bearer " + state.getters.getApiToken,
                    Accept: "application/json"
                }
            });

            const validMyTeam = await status(myTeamRaw);

            const myTeam = await validMyTeam.json();

            state.commit("setMyTeam", myTeam.team);
        },

        async sendToTrader(state, payload) {
            // GET current user's team

            const myTradeRaw = await fetch(
                url + "users/" + payload.trader_id + "/team",
                {
                    method: "POST",
                    body: JSON.stringify({
                        pokemon_id: payload.pok_id.toString()
                    }),
                    headers: {
                        Authorization: "Bearer " + state.getters.getApiToken,
                        Accept: "application/json",
                        "Content-type": "application/json"
                    }
                }
            );

            const validTradeRaw = await status(myTradeRaw);

            const trade = await validTradeRaw.json();

            state.dispatch("myTeam");
        }
    },

    modules: {},

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
        getEvolPok2(state) {
            return state.evolPok2;
        },

        getUsers(state) {
            return state.users;
        },

        getMyProfile(state) {
            // Nico
            return state.myProfile;
        },

        getMyUserProfile(state) {
            // Nico
            return state.myUserProfile;
        },

        getMyTeam(state) {
            // Nico
            return state.myTeam;
        },

        getApiToken(state) {
            return state.apiToken;
        }
    },

    plugins: [createPersistedState()]
};

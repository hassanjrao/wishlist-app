<template>
  <!-- Header -->
  <div id="topBar">
    <div class="text-center">
      <h1 class="fw-bold mb-2">Create Account</h1>
    </div>

    <div class="row g-0 justify-content-center">
      <div class="col-sm-4 col-xl-4">
        <div
          v-if="errorMessage"
          class="alert alert-danger text-center w-100"
          role="alert"
        >
          {{ errorMessage }}
        </div>

        <div
          v-if="successMessage"
          class="alert alert-success text-center w-100"
          role="alert"
        >
          {{ successMessage }}
        </div>
      </div>
      <div class="col-sm-11 col-xl-11" v-if="step">
        <div class="text-center mb-5">
          <!-- error alert -->
        </div>

        <div v-if="step == 1">
          <div class="row mb-4">
            <div class="col-lg-6">
              <label for="name" class="form-label">Name</label>
              <input
                required
                type="text"
                class="form-control form-control-lg"
                id="name"
                placeholder="Name"
                v-model="user.name"
              />

              <span class="text-danger" role="alert">
                <strong>{{ validationErrors.name }}</strong>
              </span>
            </div>
            <div class="col-lg-6">
              <label for="email" class="form-label">Email</label>
              <input
                required
                type="email"
                class="form-control form-control-lg"
                id="email"
                placeholder="Email"
                v-model="user.email"
              />
              <span class="text-danger" role="alert">
                <strong>{{ validationErrors.email }}</strong>
              </span>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-lg-6">
              <label for="state" class="form-label">State</label>
              <select id="state" v-model="user.state" class="form-select">
                <option value="">Select State</option>
                <option v-for="state in states" :key="state.id" :value="state.id">
                  {{ state.name }}
                </option>
              </select>
              <span class="text-danger" role="alert">
                <strong>{{ validationErrors.state }}</strong>
              </span>
            </div>
            <div class="col-lg-6">
              <label for="password" class="form-label">Password</label>
              <input
                required
                type="password"
                class="form-control form-control-lg"
                id="password"
                placeholder="Password"
                v-model="user.password"
              />
              <span class="text-danger" role="alert">
                <strong>{{ validationErrors.password }}</strong>
              </span>
            </div>
          </div>

          <div class="row mb-4">
            <div class="col-lg-6">
              <label for="income" class="form-label">Income</label>
              <input
                required
                type="number"
                step="0.01"
                class="form-control form-control-lg"
                id="income"
                placeholder="Income (optional)"
                v-model="user.income"
              />
              <span class="text-danger" role="alert">
                <strong>{{ validationErrors.income }}</strong>
              </span>
            </div>
            <div class="col-lg-6">
              <label for="password" class="form-label">Tax Return Certificate (image - optional)</label>
              <input
                required
                type="file"
                class="form-control form-control-lg"
                id="income_certificate"
                placeholder="income_certificate"
                accept="image/*"
                @change="user.income_certificate = $event.target.files[0]"
              />
              <span class="text-danger" role="alert">
                <strong>{{ validationErrors.income_certificate }}</strong>
              </span>
            </div>
          </div>
        </div>

        <div v-if="step == 2">
          <div>
            <div class="col-lg-12">
              <div>
                <p class="">
                  Your income should be in following range; You can submit your income to be verified later if you so wish later in profile section but it is not required
                </p>
                <div class="d-flex justify-content-between w-100 align-items-end">
                  <ul class="list-inline-with-bullets">
                    <li class="list-inline-item">$25,820 1 kid</li>
                    <li class="list-inline-item">$31,200 2 kid</li>
                    <li class="list-inline-item">$36,580 3 kid</li>
                    <li class="list-inline-item">$41,960 4 kid</li>
                    <li class="list-inline-item">$47,340 5 kid</li>
                    <li class="list-inline-item">$52,720 6 kid</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row mb-4 align-items-center">
              <div class="col-lg-2">
                <button
                  type="button"
                  class="btn btn-lg btn-alt-success"
                  @click="addWishList"
                >
                  Add More
                </button>
              </div>
            </div>
            <div class="row mb-4">
              <div
                class="col-lg-6"
                v-for="(wishList, index) in wishLists"
                :key="wishList.key"
              >
                <div class="block block-rounded">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">
                      WishList #<small>{{ wishList.number }}</small>
                    </h3>
                    <div class="block-options">
                      <button
                        v-if="wishList.number !== 1"
                        type="button"
                        class="btn-block-option"
                        data-toggle="block-option"
                        data-action="close"
                      >
                        <i class="si si-close"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content">
                    <div class="row mb-4">
                      <div class="col-lg-6">
                        <label for="name" class="form-label">Name *</label>
                        <input
                          required
                          type="text"
                          class="form-control form-control-lg"
                          id="name"
                          placeholder="Name*"
                          v-model="wishList.name"
                        />

                        <span class="text-danger" role="alert">
                          <strong>{{ validationErrors.name }}</strong>
                        </span>
                      </div>
                      <div class="col-lg-6">
                        <label for="name" class="form-label">Gender *</label>
                        <select required class="form-select" v-model="wishList.gender">
                          <option value="">Select Gender</option>
                          <option v-for="gender in genders" :key="gender" :value="gender">
                            {{ gender }}
                          </option>
                        </select>
                        <span class="text-danger" role="alert">
                          <strong>{{ validationErrors.gender }}</strong>
                        </span>
                      </div>
                    </div>

                    <div class="row mb-4">
                      <!-- <div class="col-lg-6">
                        <label for="dob" class="form-label">Birth Certificate*</label>
                        <input
                          required
                          type="file"
                          class="form-control form-control-lg"
                          id="birth_certificate"
                          placeholder="Birth Certificate*"
                          @change="wishList.birth_certificate = $event.target.files[0]"
                        />
                        <span class="text-danger" role="alert">
                          <strong>{{ validationErrors.dob }}</strong>
                        </span>
                      </div> -->
                      <div class="col-lg-6">
                        <label for="dob" class="form-label">Date of Birth*</label>
                        <input
                          required
                          type="date"
                          class="form-control form-control-lg"
                          id="dob"
                          v-model="wishList.dob"
                        />
                        <span class="text-danger" role="alert">
                          <strong>{{ validationErrors.dob }}</strong>
                        </span>
                      </div>
                      <div class="col-lg-6">
                        <label for="image" class="form-label">Image</label>
                        <input
                          required
                          type="file"
                          class="form-control form-control-lg"
                          id="image"
                          placeholder="image"
                          @change="wishList.image = $event.target.files[0]"
                        />
                        <span>Image is optional</span>

                        <span class="text-danger" role="alert">
                          <strong>{{ validationErrors.image }}</strong>
                        </span>
                      </div>
                    </div>

                    <div class="row mb-4">
                      <div class="col-lg-12">
                        <label for="url" class="form-label">WishList Link*</label>
                        <input
                          required
                          type="url"
                          class="form-control form-control-lg"
                          id="url"
                          placeholder="URL*"
                          v-model="wishList.wishListLink"
                        />

                        <span class="text-danger" role="alert">
                          <strong>{{ validationErrors.wishListLink }}</strong>
                        </span>
                      </div>
                    </div>

                    <div class="row mb-4">
                      <div class="col-lg-12">
                        <label for="about" class="form-label">About*</label>
                        <textarea
                          required
                          class="form-control form-control-lg"
                          id="about"
                          placeholder="About*"
                          v-model="wishList.about"
                          rows="8"
                        ></textarea>

                        <span class="text-danger" role="alert">
                          <strong>{{ validationErrors.about }}</strong>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-2">
          <button
            type="button"
            @click="prevStep"
            class="btn btn-lg btn-alt-secondary"
            v-if="step > 1"
          >
            <i class="fa fa-fw fa-arrow-left me-1 opacity-50"></i>
            Prev
          </button>

          <button
            type="button"
            @click="nextStep"
            v-if="step < 2"
            class="btn btn-lg btn-alt-success"
            :disabled="loading"
          >
            <i class="fa fa-fw fa-arrow-right me-1 opacity-50"></i>
            Next
          </button>

          <button
            type="button"
            @click="submit"
            v-if="step == 2"
            class="btn btn-lg btn-alt-success"
            :disabled="loading"
          >
            <i class="fa fa-fw fa-check me-1 opacity-50"></i>
            Submit
          </button>
        </div>

        <p class="text-center mt-3">
          <a class="fw-medium" href="/login">Already have an account? Login</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import WishList from "./WishList.vue";

export default {
  props: {
    states: {
      type: Array,
      required: true,
    },
    genders: {
      type: Array,
      required: true,
    },
  },

  mounted() {
    console.log("Component mounted.");
  },

  components: {
    WishList,
  },

  data() {
    return {
      errorMessage: null,
      successMessage: null,
      step: 1,
      loading: false,
      user: {
        id: null,
        name: "",
        email: "",
        state: "",
        password: "",
        income: "",
        income_certificate: "",
      },
      validationErrors: {
        name: "",
        email: "",
        password: "",
        income: "",
        income_certificate: "",
      },
      userId: null,
      wishLists: [
        {
          key: "wishList1",
          number: 1,
          id: null,
          name: "",
          image: "",
          dob: "",
          //   birth_certificate: "",
          wishListLink: "",
          about: "",
          gender: "",
        },
      ],
    };
  },

  methods: {
    nextStep() {
      this.clearValidationErrors();

      if (this.step == 1) {
        let valid = this.step1Validation();

        if (!valid) {
          return;
        }

        if (
          this.createUser().then((response) => {
            if (response) {
              this.step++;
            }
          })
        );
      } else {
        this.step++;
      }

      //   this.step++;
    },

    prevStep() {
      this.step--;
    },

    wishListValidation() {
      let valid = true;

      this.errorMessage = null;

      console.log(this.wishLists);

      let errorMsg = "";

      this.wishLists.forEach((wishList) => {
        if (
          !wishList.name ||
          !wishList.dob ||
          //   (!wishList.birth_certificate_url && !wishList.birth_certificate) ||
          !wishList.wishListLink ||
          !wishList.about ||
          !wishList.gender
        ) {
          errorMsg = "Fields with * are required";
          valid = false;
        }

        if (wishList.wishListLink) {
          // only amazon.com domain allowed in submited url area
          if (!wishList.wishListLink.includes("amazon.com")) {
            errorMsg = "Only amazon.com domain allowed in WishList Link";
            valid = false;
          }
        }
      });

      if (!valid) {
        this.errorMessage = errorMsg;

        // scroll to topBar
        document.getElementById("topBar").scrollIntoView();


        return false;
      }

      return true;
    },

    addWishList() {
      // wishlist validation
      if (!this.wishListValidation()) {
        return;
      }

      //   add wishlist at first
      this.wishLists.unshift({
        key: Math.random() + "wishList",
        number: this.wishLists.length + 1,
        id: null,
        name: "",
        image: "",
        dob: "",
        // birth_certificate: "",
        wishListLink: "",
        about: "",
        gender: "",
      });
    },

    clearValidationErrors() {
      this.errorMessage = null;
      this.validationErrors = {
        name: "",
        email: "",
        password: "",
        income: "",
        income_certificate: "",
      };
    },

    step1Validation() {
      // clear all validation errors

      this.clearValidationErrors();

      if (!this.user.name) {
        this.validationErrors.name = "Name is required";
      }

      if (!this.user.email) {
        this.validationErrors.email = "Email is required";
      }

      if (!this.user.state) {
        this.validationErrors.state = "State is required";
      }

      if (!this.user.password) {
        this.validationErrors.password = "Password is required";
      }

      if (this.user.password && this.user.password.length < 6) {
        this.validationErrors.password = "Password must be at least 6 characters";
      }

      //if (!this.user.income) {
        //this.validationErrors.income = "Income is required";
      //}

      if (this.user.income && this.user.income < 0) {
        this.validationErrors.income = "Income must be greater than 0";
      }

    //   if (!this.user.income_certificate) {
    //     this.validationErrors.income_certificate = "Tax Return Certificate is required";
    //   }

      if (
        this.validationErrors.name ||
        this.validationErrors.email ||
        this.validationErrors.state ||
        this.validationErrors.password
        //this.validationErrors.income ||
        //this.validationErrors.income_certificate
      ) {
        return false;
      }

      return true;
    },

    async createUser() {
      console.log(this.user);

      this.loading = true;

      let formData = new FormData();
      formData.append("name", this.user.name);
      formData.append("email", this.user.email);
      formData.append("state", this.user.state);
      formData.append("password", this.user.password);
      formData.append("income", this.user.income);
      formData.append("income_certificate", this.user.income_certificate);

      return await axios
        .post("user-register", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          console.log(response.data);

          let data = response.data.data;

          this.userId = data.user.id;
          this.user.id = data.user.id;

          this.loading = false;

          return true;
        })
        .catch((error) => {
          console.log(error.response.data);

          let errors = error.response.data.errors;

          this.errorMessage = error.response.data.message;

          this.validationErrors = {
            name: errors.name ? errors.name.join(", ") : "",
            email: errors.email ? errors.email.join(", ") : "",
            state: errors.state ? errors.state.join(", ") : "",
            password: errors.password ? errors.password.join(", ") : "",
            income: errors.income ? errors.income.join(", ") : "",
            income_certificate: errors.income_certificate
              ? errors.income_certificate.join(", ")
              : "",
          };

          this.loading = false;

          return false;
        });
    },

    submit() {
      console.log(this.wishLists);

      this.clearValidationErrors();

      if (!this.wishListValidation()) {
        return;
      }

      // make form data

      this.loading = true;

      let formData = new FormData();

      formData.append("user_id", this.userId);

      this.wishLists.forEach((wishList, index) => {
        formData.append(`wishLists[${index}][name]`, wishList.name);
        formData.append(`wishLists[${index}][dob]`, wishList.dob);
        formData.append(`wishLists[${index}][wishListLink]`, wishList.wishListLink);
        formData.append(`wishLists[${index}][about]`, wishList.about);
        formData.append(`wishLists[${index}][gender]`, wishList.gender);

        if (wishList.image) {
          formData.append(`wishLists[${index}][image]`, wishList.image);
        }

        // if (wishList.birth_certificate) {
        //   formData.append(
        //     `wishLists[${index}][birth_certificate]`,
        //     wishList.birth_certificate
        //   );
        // }
      });

      axios
        .post("user-register/add-wishlist", formData, {
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((response) => {
          console.log(response.data);

          this.loading = false;

          this.step = null;

          this.successMessage = response.data.message;

          //   redirect after 5 seconds

          setTimeout(() => {
            window.location.href = "/user/wishlist/create";
          }, 2000);

          //   redirect to login page
        })
        .catch((error) => {
          console.log(error.response.data);

          this.loading = false;
        });
    },
  },
};
</script>

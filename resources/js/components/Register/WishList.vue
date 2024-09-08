<template>
  <div>
    <div class="row mb-4 align-items-center justify-content-between">
      <div class="col-lg-2">
        <button type="button" class="btn btn-lg btn-alt-success" @click="addWishList">
          Add More
        </button>
      </div>

      <div class="col-lg-2">
        <button type="button" class="btn btn-lg btn-alt-primary" @click="submit">
          Submit
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div v-if="errorMessage" class="alert alert-danger text-center w-50" role="alert">
          {{ errorMessage }}
        </div>

        <div
          v-if="successMessage"
          class="alert alert-success text-center w-50"
          role="alert"
        >
          {{ successMessage }}
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-lg-6" v-for="(wishList, index) in wishLists" :key="wishList.key">
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
                <label for="dob" class="form-label">
                  <a
                    :href="wishList.birth_certificate_url"
                    v-if="wishList.birth_certificate_url"
                    target="_blank"
                    >Birth Certificate*</a
                  >

                  <span v-else>Birth Certificate*</span>
                </label>

                <input
                  required
                  type="file"
                  class="form-control form-control-lg"
                  id="birth_certificate"
                  placeholder="Birth Certificate*"
                  <!-- @change="wishList.birth_certificate = $event.target.files[0]"
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
                <label for="image" class="form-label"></label>
                <a :href="wishList.image_url" v-if="wishList.image_url" target="_blank"
                  >Image</a
                >

                <span v-else>Image</span>
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
</template>

<script>
export default {
  props: {
    genders: {
      required: true,
    },
  },

  mounted() {
    console.log("Component mounted.");
    this.getWishLists();
  },
  data() {
    return {
      errorMessage: null,
      successMessage: null,
      removedWishLists: [],

      validationErrors: {
        name: "",
        dob: "",
        image: "",
        wishListLink: "",
        about: "",
        gender: "",
      },
      wishLists: [
        {
          key: "wishList1",
          number: 1,
          id: null,
          name: "",
          image: "",
          image_url: "",
          dob: "",
          //   birth_certificate: "",
          //   birth_certificate_url: "",
          wishListLink: "",
          about: "",
          gender: "",
        },
      ],
    };
  },

  methods: {
    removeWisList(wishList) {
      if (wishList.id) {
        this.removedWishLists.push(wishList.id);
      }

      console.log(this.removedWishLists);
      this.wishLists = this.wishLists.filter((item) => item !== wishList);
    },

    addWishList() {
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

    wishListValidation() {
      let valid = true;

      this.errorMessage = null;
      this.validationErrors = {
        name: "",
        dob: "",
        image: "",
        wishListLink: "",
        about: "",
        gender:"",
      };

      console.log(this.wishLists);

      var index = 0;

      var errorMsg = "";

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
        index++;
      });

      if (!valid) {
        this.errorMessage = errorMsg;
        return false;
      }

      return true;
    },

    submit() {
      console.log(this.wishLists);

      if (!this.wishListValidation()) {
        return;
      }

      // make form data

      this.loading = true;

      let formData = new FormData();

      formData.append("user_id", this.userId);

      this.wishLists.forEach((wishList, index) => {
        formData.append(`wishLists[${index}][id]`, wishList.id);
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

      this.removedWishLists.forEach((id, index) => {
        formData.append(`removedWishLists[${index}]`, id);
      });

      let api = "/user/wishlist";

      axios
        .post("/user/wishlist", formData, {
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
            // reload page
            window.location.reload();
          }, 2000);

          //   redirect to login page
        })
        .catch((error) => {
          console.log(error.response.data);

          this.loading = false;
        });
    },

    getWishLists() {
      axios
        .get("/user/wishlist/get")
        .then((response) => {
          console.log(response.data);
          this.wishLists = response.data.data;

          console.log(this.wishLists);

          this.wishLists.forEach((wishList) => {
            wishList.number = this.wishLists.indexOf(wishList) + 1;
            wishList.key = Math.random() + "wishList";
          });
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>

/****All functions in this page is used for all popup in login page and post project page for registration login and post project in these pages  ******/

(function ($) {
  "use strict";
  $.Login = function (settings) {
    var config = {
      url: "",
      surl: "",
      postProject: false,
      secret: "secret@123",
    };
    if (settings) {
      $.extend(config, settings);
    }

    var projectStepDone = false;

    $(".fixed-price-box").click(function () {
      if ($("#fixed-budget").val() == 16) {
        //$("#custom_budget_section").removeClass("hide-all");
      } else {
        //$("#custom_budget_section").addClass("hide-all");
      }
      $(".budget").removeClass("hidden");
      $(".hourly-priced-box").removeClass("border-active");
      $(".fixed-price-box").addClass("border-active");
      $(".fixed-budget").removeClass("hidden");
      $(".hourly-budget").addClass("hidden");
      $("#fixed-price").prop("checked", true);
      $("#hourly-price").prop("checked", false);
      //we submit form here and at bottom
    });
    $(".hourly-priced-box").click(function () {
      if ($("#hourly-budget").val() == 16) {
        //$("#custom_budget_section").removeClass("hide-all");
      } else {
        //$("#custom_budget_section").addClass("hide-all");
      }
      $(".budget").removeClass("hidden");
      $(".fixed-price-box").removeClass("border-active");
      $(".hourly-priced-box").addClass("border-active");
      $(".hourly-budget").removeClass("hidden");
      $(".fixed-budget").addClass("hidden");
      $("#fixed-price").prop("checked", false);
      $("#hourly-price").prop("checked", true);
    });
    // Open custom budget options when selected
    $("#fixed-budget").change(function () {
      if ($("#fixed-budget").val() == 16) {
        $("#custom_budget_section").removeClass("hide-all");
      } else {
        $("#custom_budget_section").addClass("hide-all");
      }
    });
    $("#hourly-budget").change(function () {
      if ($("#hourly-budget").val() == 16) {
        $("#custom_budget_section").removeClass("hide-all");
      } else {
        $("#custom_budget_section").addClass("hide-all");
      }
    });

    //change budget currency based on currency dropdown
    var hourly_currency, fixed_currency;
    $("#hourly-currency")
      .on("focus", function () {
        hourly_currency = $(this).val();
      })
      .change(function () {
        var val = $(this).val();
        var options = $("#hourly-budget option");
        hourly_currency = hourly_currency;
        var expression = new RegExp("\\b" + hourly_currency + "\\b");

        var values = $.map(options, function (option) {
          option.text = option.text.replace(expression, val);
        });
        $(this).trigger("blur");
      });

    //on currency change, update the budget currency
    $("#fixed-currency")
      .on("focus", function () {
        hourly_currency = $(this).val();
      })
      .change(function () {
        var val = $(this).val();
        var options = $("#fixed-budget option");
        fixed_currency = fixed_currency;
        var expression = new RegExp("\\b" + hourly_currency + "\\b");

        var values = $.map(options, function (option) {
          option.text = option.text.replace(expression, val);
        });
        $(this).trigger("blur");
      });

    // $('input[name="work_type"]').change(function () {
    //   if (!$("#next-fulltime-button").is(":visible")) {
    //     var value = $('input[name="work_type"]:checked').val();
    //     if (value === "Project Based") {
    //       $("#projectbased-section").slideDown();
    //       $("#fulltime-section").slideUp();
    //     } else {
    //       $("#fulltime-section").slideDown();
    //       $("#projectbased-section").slideUp();
    //     }
    //   }
    // });
    //next step first
    $("#next-fulltime-button").click(function () {
      $("#projectbased-section").slideDown();
      $(this).parent("div").remove();
    });

    $("#next_2").click(function () {
      var name = $("#project-name").val();
      var description = $("#project-desc").val();
      var uploads = $("#project-upload").val();
      var $btn = $(this);
      if (
        name.length < 10 ||
        description.length < 50 ||
        (uploads.length < 1 &&
          $("input[name=work_type]:checked").val() === "Project Based")
      ) {
        if (name.length < 10) {
          $("#project-name").addClass("input-validation-error");
        } else {
          $("#project-name").removeClass("input-validation-error");
        }
        if (description.length < 50) {
          $("#project-desc").addClass("input-validation-error");
        } else {
          $("#project-desc").removeClass("input-validation-error");
        }
        if (
          uploads.length < 1 &&
          $("input[name=work_type]:checked").val() === "Project Based"
        ) {
          $("#upload_section").addClass("input-validation-error");
        } else {
          $("#upload_section").removeClass("input-validation-error");
        }
      } else {
        $("#project-name").removeClass("input-validation-error");
        $("#project-desc").removeClass("input-validation-error");
        $("#upload_section").removeClass("input-validation-error");
        $("#fulltime-section").slideDown();
        $(this).parent("div").remove();
      }
    });
    $("#fulltime-submit-btn").click(function () {
      // var budget = $("#budget").val();
      var $btn = $(this);
      var start = $("#start-time").val();
      var skills = [];
      
      var datas = $('.js-example-basic-multiple').find(':selected');
      $.each(datas, function (indexInArray, valueOfElement) { 

        skills.push(" " + valueOfElement.innerText);

      });
    
      
      console.log(skills);
      var name = $("#project-name").val();
      var description = $("#project-desc").val();
      var uploads = $("#project-upload").val();
      var $btn = $(this);

      if (
        name.length < 10 ||
        description.length < 50 ||
        (uploads.length < 1 &&
          $("input[name=work_type]:checked").val() === "Project Based") ||
        skills.length == 0 ||
        start.length == 0
      ) {
        if (name.length < 10) {
          $("#project-name").addClass("input-validation-error");
        } else {
          $("#project-name").removeClass("input-validation-error");
        }
        if (description.length < 50) {
          $("#project-desc").addClass("input-validation-error");
        } else {
          $("#project-desc").removeClass("input-validation-error");
        }
        if (
          uploads.length < 1 &&
          $("input[name=work_type]:checked").val() === "Project Based"
        ) {
          $("#upload_section").addClass("input-validation-error");

          $([document.documentElement, document.body]).animate(
            {
              scrollTop: $("#project-upload").offset().top - 150,
            },
            700
          );
          console.log($("#skills_container").offset().top);
        } else {
          $("#upload_section").removeClass("input-validation-error");
        }
        if (skills.length == 0) {
          $("#minimum_skill_select").removeClass("hide-all");
          $("#skills_container").addClass("input-validation-error");
          if (
            uploads.length > 1 ||
            (uploads.length < 1 &&
              $("input[name=work_type]:checked").val() !== "Project Based")
          ) {
            $([document.documentElement, document.body]).animate(
              {
                scrollTop: $("#skills_container").offset().top - 150,
              },
              700
            );
          }
        } else {
          $("#minimum_skill_select").addClass("hide-all");
          $("#skills_container").removeClass("input-validation-error");
        }
        if (start.length < 2) {
          $("#start-time").addClass("input-validation-error");
        } else {
          $("#start-time").removeClass("input-validation-error");
        }
      } else {
        $("#project-name").removeClass("input-validation-error");
        $("#project-desc").removeClass("input-validation-error");
        $("#upload_section").removeClass("input-validation-error");
        $("#skills").removeClass("input-validation-error");
        $("#start-time").removeClass("input-validation-error");
        $("#minimum_skill_select").addClass("hide-all");
        $("#skills_container").removeClass("input-validation-error");
        if (
          (parseInt($("#hourly-budget").val()) == 16 ||
            parseInt($("#fixed-budget").val()) == 16) &&
          (parseInt($("#min_budget").val()) <= 0 ||
            parseInt($("#max_budget").val()) <= 0 ||
            parseInt($("#min_budget").val()) >=
              parseInt($("#max_budget").val()))
        ) {
          if (
            parseInt($("#min_budget").val()) <= 0 ||
            parseInt($("#min_budget").val()) >= parseInt($("#max_budget").val())
          ) {
            $("#min_budget").addClass("input-validation-error");
          } else {
            if ($("#min_budget").hasClass("input-validation-error")) {
              $("#min_budget").removeClass("input-validation-error");
            }
          }
          if ($("#max_budget").val() <= 0) {
            $("#max_budget").addClass("input-validation-error");
          } else {
            if ($("#max_budget").hasClass("input-validation-error")) {
              $("#max_budget").removeClass("input-validation-error");
            }
          }
        } else {
          if ($("#min_budget").hasClass("input-validation-error")) {
            $("#min_budget").removeClass("input-validation-error");
          }
          if ($("#max_budget").hasClass("input-validation-error")) {
            $("#max_budget").removeClass("input-validation-error");
          }
          $btn.addClass("loading");
          postProject($btn);
        }
      }
    });

    //eye toggle password
    $(".eye-toggler")
      .unbind()
      .click(function () {
        var passForm = $(this).prev();
        if (passForm.attr("type") === "password") {
          passForm.attr("type", "text");
          $(this).addClass("icon-feather-eye-off");
        } else {
          passForm.attr("type", "password");
          $(this).removeClass("icon-feather-eye-off");
        }
      });

    //go to forgot password from login
    $("#passreset").on("click", function () {
      $("#loginform").slideUp();
      $("#passform").slideDown();
    });
    //back to login from forgot password
    $("#backto").on("click", function () {
      $("#loginform").slideDown();
      $("#passform").slideUp();
    });
    //back to login from signup
    $("#loginPage").on("click", function () {
      $("#step-1").slideUp();
      $("#loginform").slideDown();
    });
    //go to step-1 from login
    $("#signup").on("click", function () {
      $("#loginform").slideUp();
      $("#step-1").slideDown();
    });

    //close registration popup
    $(".closeRegistration").on("click", function () {
      $("#step-1").slideUp();
      $("#loginform").slideUp();
      $("#project-form").slideDown();
    });

    //login
    $("button[name=doLogin]").on("click", function () {
      var $btn = $(this);
      $btn.addClass("loading");
      var username = $("input[name=email]").val();
      var password = $("input[name=password]").val();
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: {
          action: "userLogin",
          username: username,
          password: password,
        },
        dataType: "json",
        success: function (json) {
          if (json.type === "error" || json.type === "alert") {
            if (json.registration) {
              //check if it is post project and redirect is to user type
              if (config.postProject && json.redirect === "type") {
                setUserType(username, password);
                return;
              }
              $("input[name=u]").val(
                CryptoJS.AES.encrypt(username, config.secret).toString()
              );
              $("input[name=p]").val(
                CryptoJS.AES.encrypt(password, config.secret).toString()
              );
              switch (json.redirect) {
                case "verification":
                  $("#loginform").slideUp();
                  $("#step-2").slideDown();
                  break;
                case "username":
                  $("#loginform").slideUp();
                  $("#step-3").slideDown();
                  break;
                case "type":
                  $("#loginform").slideUp();
                  $("#step-4").slideDown();
                  break;
                default:
                  break;
              }
            }

            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
          } else {
            if (config.postProject) {
              if (json.redirect === "/master/profile/edit") {
                $("#loginform").slideUp();
                $("#client_form").slideDown();
              } else {
                postProject();
              }
            } else {
              window.location.href = config.surl + json.redirect;
            }
          }
          $btn.removeClass("loading");
        },
      });
    });
    //password reset
    $("button[name=doPass]").on("click", function () {
      var $btn = $(this);
      $btn.addClass("loading");
      var email = $("input[name=forgotEmail]").val();
      var fname = $("input[name=fname]").val();
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: {
          action: "uResetPass",
          email: email,
          fname: fname,
          front: true,
        },
        dataType: "json",
        success: function (json) {
          $.wNotice(decodeURIComponent(json.message), {
            autoclose: 6000,
            type: json.type,
            title: json.title,
          });
          if (json.type === "success") {
            $btn.prop("disabled", true);
          }
          $btn.removeClass("loading");
        },
      });
    });
    //register
    $(".step-1-button").on("click", function () {
      var $btn = $(this);
      $btn.addClass("loading");
      var username = $("input[name=registerEmail]").val();
      var password = $("input[name=registerPassword]").val();
      var agreement = $("input[name=agreement]").is(":checked");
      $("input[name=u]").val(
        CryptoJS.AES.encrypt(username, config.secret).toString()
      );
      $("input[name=p]").val(
        CryptoJS.AES.encrypt(password, config.secret).toString()
      );
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: {
          action: "userRegister",
          username: username,
          password: password,
          agreement: agreement,
        },
        dataType: "json",
        success: function (json) {
          if (json.type === "error") {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
          } else {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
            $("#step-1").slideUp();
            $("#step-2").slideDown();
          }
          $btn.removeClass("loading");
        },
      });
    });
    //check verification
    $(".step-2-button,.resend-email").on("click", function () {
      var $btn = $(this);
      $btn.addClass("loading");
      var username = $("input[name=u]").val();
      var password = $("input[name=p]").val();
      username = CryptoJS.AES.decrypt(username, config.secret).toString(
        CryptoJS.enc.Utf8
      );
      password = CryptoJS.AES.decrypt(password, config.secret).toString(
        CryptoJS.enc.Utf8
      );
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: {
          action: "userIsVerified",
          username: username,
          password: password,
          resend: $btn.hasClass("resend-email"),
        },
        dataType: "json",
        success: function (json) {
          if (json.type === "error") {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
          } else {
            if (json.message) {
              $.wNotice(decodeURIComponent(json.message), {
                autoclose: 6000,
                type: json.type,
                title: json.title,
              });
            } else {
              $("#step-2").slideUp();
              $("#step-3").slideDown();
            }
          }
          $btn.removeClass("loading");
        },
      });
    });
    //update username
    $(".step-3-button").on("click", function () {
      var $btn = $(this);
      $btn.addClass("loading");
      var email = $("input[name=u]").val();
      var username = $("input[name=username]").val();
      var password = $("input[name=p]").val();
      email = CryptoJS.AES.decrypt(email, config.secret).toString(
        CryptoJS.enc.Utf8
      );
      password = CryptoJS.AES.decrypt(password, config.secret).toString(
        CryptoJS.enc.Utf8
      );
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: {
          action: "uSetUsername",
          email: email,
          username: username,
          password: password,
        },
        dataType: "json",
        success: function (json) {
          if (json.type === "error") {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
          } else {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
            //check if user is posting  project and need to set user type
            if (config.postProject) {
              setUserType(email, password);
            } else {
              $("#step-3").slideUp();
              $("#step-4").slideDown();
            }
          }
          $btn.removeClass("loading");
        },
      });
    });
    //update user type
    $("#work,#hire").on("click", function () {
      var $btn = $(this);
      var type = $btn.data("type");
      var email = $("input[name=u]").val();
      var password = $("input[name=p]").val();
      email = CryptoJS.AES.decrypt(email, config.secret).toString(
        CryptoJS.enc.Utf8
      );
      password = CryptoJS.AES.decrypt(password, config.secret).toString(
        CryptoJS.enc.Utf8
      );
      setUserType(email, password, type);
    });

    //complete client profile
    $("#client_profile").on("click", function () {
      var $btn = $(this);
      $btn.addClass("loading");
      var form = $("#client_form");
      var formdata = new FormData(form[0]);
      formdata.append("action", "doUpdate");
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: formdata,
        success: function (json) {
          json = JSON.parse(json);
          if (json.type === "error" || json.type === "alert") {
            if (json.message) {
              $.wNotice(decodeURIComponent(json.message), {
                autoclose: 6000,
                type: json.type,
                title: json.title,
              });
            }
          } else {
            // $.wNotice(decodeURIComponent(json.message), {
            //   autoclose: 6000,
            //   type: json.type,
            //   title: json.title,
            // });
            if (config.postProject) {
              $("#client_form").slideUp();
              $("#project-form").slideDown();
              form[0].reset();
              postProject();
            }
          }
          if ($btn) $btn.removeClass("loading");
        },
        cache: false,
        contentType: false,
        processData: false,
      });
    });

    //set user type if user is registrating and posting project
    function setUserType(email, password, type = "hire") {
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: {
          action: "uSetType",
          type: type,
          email: email,
          password: password,
        },
        dataType: "json",
        success: function (json) {
          if (json.type === "error") {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
          } else {
            //if user type set then login user and post project
            loginUser(email, password);
          }
        },
      });
    }

    //login function for user after setting user type
    function loginUser(email, password) {
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: {
          action: "userLogin",
          username: email,
          password: password,
        },
        dataType: "json",
        success: function (json) {
          if (json.type === "error" || json.type === "alert") {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
          } else {
            if (
              config.postProject &&
              (json.redirect === "/master/" ||
                json.redirect === "/master/project/new")
            ) {
              postProject();
            } else if (
              config.postProject &&
              json.redirect === "/master/profile/edit"
            ) {
              $("#loginform").slideUp();
              $("#step-3").slideUp();
              $("#client_form").slideDown();
            } else {
              // alert(json.redirect);
              window.location.href = config.surl + json.redirect;
            }
          }
        },
      });
    }

    //function to post project
    function postProject($btn = false) {
      var form = $("#project-form");
      var formdata = new FormData(form[0]);
      formdata.append("action", "postproject");
      $.ajax({
        type: "post",
        url: config.url + "/controller.php",
        data: formdata,
        success: function (json) {
          json = JSON.parse(json);
          if (json.type === "error" || json.type === "alert") {
            if (json.registration && json.redirect == "register") {
              $("#project-form").slideUp();
              $("#step-1").slideDown();
            } else if (json.registration && json.redirect == "profile") {
              $("#project-form").slideUp();
              $("#client_form").slideDown();
            } else {
              $("#loginform").slideUp();
              $("#step-1").slideUp();
              $("#step-2").slideUp();
              $("#step-3").slideUp();
              $("#project-form").slideDown();
            }
            if (json.message) {
              $.wNotice(decodeURIComponent(json.message), {
                autoclose: 6000,
                type: json.type,
                title: json.title,
              });
            }
          } else {
            $.wNotice(decodeURIComponent(json.message), {
              autoclose: 6000,
              type: json.type,
              title: json.title,
            });
            $("#loginform").slideUp();
            $("#step-1").slideUp();
            $("#step-2").slideUp();
            $("#step-3").slideUp();
            $("#project-form").slideDown();
            form[0].reset();
            setTimeout(() => {
              window.location.href = json.redirect;
            }, 1000);
          }
          if ($btn) $btn.removeClass("loading");
        },
        cache: false,
        contentType: false,
        processData: false,
      });
    }
  };
})(jQuery);

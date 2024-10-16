<template>
    <form>
        <FormGroup label="Включен" group-type="checkbox">
            <input class="form-check-input" type="checkbox" v-model="question.is_enabled" />
        </FormGroup>
        <FormGroup label="Название" :has-validation="true">
            <input type="text" class="form-control" :class="{
                'is-invalid': errors.name.length > 0
            }" v-model="question.name" placeholder="Название" />
            <div class="invalid-feedback">
                {{ errors.name }}
            </div>
        </FormGroup>
        <FormSubmit @click.prevent="onSubmit" :label="submitLabel" />
        <RouterLink
            to="/questions"
            class="btn btn-secondary mx-2">
            Отмена
        </RouterLink>
        <RouterLink
            v-if="this.hasId"
            :to="deleteHref"
            class="btn btn-outline-danger action mx-2">
            Удалить
        </RouterLink>
    </form>
</template>

<script>
import FormSubmit from "../../../../vue/Components/Form/FormSubmit.vue";
import FormGroup from "../../../../vue/Components/Form/FormGroup.vue";
import {isNumber} from "lodash";
import {getQuestionsRoute} from "../../../api/questions";

export default {
    name: "QuestionForm",
    components: {FormGroup, FormSubmit},
    props: {
        question: {
          type: Object,
          default: {
              id: null,
              is_enabled: true,
              name: ''
          }
      },
        onSubmit: {
          type: Function,
            default: function (){
                console.log('Submit');
            }
        },
        submitLabel: {
          type: String,
            default: 'Отправить'
        },
        errors: {
          type: Object,
            default: {
                name: ''
            }
        }
    },
    computed: {
        hasId() {
          return isNumber(this.question.id);
        },
        deleteHref() {
            if(this.hasId){
                return getQuestionsRoute('delete', {id: this.question.id});
            }
            return '';
        }
    }
}
</script>

<style scoped>

</style>

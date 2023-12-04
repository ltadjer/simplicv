import { mount } from '@vue/test-utils';
import CVModelsView from '../views/CVModelsView.vue';

describe('CVModelsView.vue', () => {
  it('affiche un message d\'erreur pour un email invalide', async () => {
    const wrapper = mount(CVModelsView);
    await wrapper.setData({ mailAddress: 'email-invalid' });

    const errorMessage = wrapper.find('.error-message');
    expect(errorMessage.exists()).toBe(true);
    expect(errorMessage.text()).toBe('Adresse e-mail invalide.');
  });

  it('affiche un message d\'erreur pour un numéro de téléphone invalide', async () => {
    const wrapper = mount(CVModelsView);
    await wrapper.setData({ phoneNumber: '123' });

    const errorMessage = wrapper.find('.error-message');
    expect(errorMessage.exists()).toBe(true);
    expect(errorMessage.text()).toBe('Numéro de téléphone invalide.');
  });

  it('affiche un message d\'erreur pour un code postal invalide', async () => {
    const wrapper = mount(CVModelsView);
    await wrapper.setData({ zipCode: '1234' });

    const errorMessage = wrapper.find('.error-message');
    expect(errorMessage.exists()).toBe(true);
    expect(errorMessage.text()).toBe('Code postal invalide.');
  });
});

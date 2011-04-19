require 'test_helper'

class ConcessionairesControllerTest < ActionController::TestCase
  setup do
    @concessionaire = concessionaires(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:concessionaires)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create concessionaire" do
    assert_difference('Concessionaire.count') do
      post :create, :concessionaire => @concessionaire.attributes
    end

    assert_redirected_to concessionaire_path(assigns(:concessionaire))
  end

  test "should show concessionaire" do
    get :show, :id => @concessionaire.to_param
    assert_response :success
  end

  test "should get edit" do
    get :edit, :id => @concessionaire.to_param
    assert_response :success
  end

  test "should update concessionaire" do
    put :update, :id => @concessionaire.to_param, :concessionaire => @concessionaire.attributes
    assert_redirected_to concessionaire_path(assigns(:concessionaire))
  end

  test "should destroy concessionaire" do
    assert_difference('Concessionaire.count', -1) do
      delete :destroy, :id => @concessionaire.to_param
    end

    assert_redirected_to concessionaires_path
  end
end

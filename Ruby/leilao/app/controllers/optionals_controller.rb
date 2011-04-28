class OptionalsController < ApplicationController
  load_and_authorize_resource
  # GET /optionals
  # GET /optionals.xml
  def index
    @optionals = Optional.all

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @optionals }
    end
  end

  # GET /optionals/1
  # GET /optionals/1.xml
  def show
    @optional = Optional.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @optional }
    end
  end

  # GET /optionals/new
  # GET /optionals/new.xml
  def new
    @optional = Optional.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @optional }
    end
  end

  # GET /optionals/1/edit
  def edit
    @optional = Optional.find(params[:id])
  end

  # POST /optionals
  # POST /optionals.xml
  def create
    @optional = Optional.new(params[:optional])

    respond_to do |format|
      if @optional.save
        format.html { redirect_to(@optional, :notice => 'Optional was successfully created.') }
        format.xml  { render :xml => @optional, :status => :created, :location => @optional }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @optional.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /optionals/1
  # PUT /optionals/1.xml
  def update
    @optional = Optional.find(params[:id])

    respond_to do |format|
      if @optional.update_attributes(params[:optional])
        format.html { redirect_to(@optional, :notice => 'Optional was successfully updated.') }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @optional.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /optionals/1
  # DELETE /optionals/1.xml
  def destroy
    @optional = Optional.find(params[:id])
    @optional.destroy

    respond_to do |format|
      format.html { redirect_to(optionals_url) }
      format.xml  { head :ok }
    end
  end
end

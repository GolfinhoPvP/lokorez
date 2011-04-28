class ConcessionairesController < ApplicationController
  load_and_authorize_resource
  # GET /concessionaires
  # GET /concessionaires.xml
  def index
    @concessionaires = Concessionaire.all

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @concessionaires }
    end
  end

  # GET /concessionaires/1
  # GET /concessionaires/1.xml
  def show
    @concessionaire = Concessionaire.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @concessionaire }
    end
  end

  # GET /concessionaires/new
  # GET /concessionaires/new.xml
  def new
    @concessionaire = Concessionaire.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @concessionaire }
    end
  end

  # GET /concessionaires/1/edit
  def edit
    @concessionaire = Concessionaire.find(params[:id])
  end

  # POST /concessionaires
  # POST /concessionaires.xml
  def create
    @concessionaire = Concessionaire.new(params[:concessionaire])

    respond_to do |format|
      if @concessionaire.save
        format.html { redirect_to(@concessionaire, :notice => 'Concessionaire was successfully created.') }
        format.xml  { render :xml => @concessionaire, :status => :created, :location => @concessionaire }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @concessionaire.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /concessionaires/1
  # PUT /concessionaires/1.xml
  def update
    @concessionaire = Concessionaire.find(params[:id])

    respond_to do |format|
      if @concessionaire.update_attributes(params[:concessionaire])
        format.html { redirect_to(@concessionaire, :notice => 'Concessionaire was successfully updated.') }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @concessionaire.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /concessionaires/1
  # DELETE /concessionaires/1.xml
  def destroy
    @concessionaire = Concessionaire.find(params[:id])
    @concessionaire.destroy

    respond_to do |format|
      format.html { redirect_to(concessionaires_url) }
      format.xml  { head :ok }
    end
  end
end

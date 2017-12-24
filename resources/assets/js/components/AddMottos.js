/**
 * Created by linsen on 2017/12/19.
 */
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
class AddMottos extends  Component{
    constructor(props){
        super(props);
        this.state={
            newMotto: {
                pic: '',
                englishWord: '',
                chineseWord: '',
                xiaobian: '',
                audio:''
            }
        }
        this.handleSubmit=this.handleSubmit.bind(this);
        this.handleInput=this.handleInput.bind(this);
    }
    handleInput(key,e){
        var state=Object.assign({},this.state.newMotto);
        state[key]=e.target.value;
        this.setState({newMotto:state});
    }
    handleSubmit(e){
        e.preventDefault();
        this.props.onAdd(this.state.newMotto);
    }
    render(){

        return(

                    <form onSubmit={this.handleSubmit} className="form-horizontal">
                        <h3 className="text-center">添加内容</h3>
                    <div  className="form-group" >
                        <div className="col-md-1 text-right" >
                        <label className="control-label"> 英文:</label>
                        </div>
                    <div className="col-md-11">
                    <textarea onChange={(e)=>this.handleInput('englishWord',e)} rows="3" className="form-control"/>
                    </div>
                    </div>
                     <div  className="form-group" >
                         <div className="col-md-1 text-right" >
                        <lable className="control-label"> 中文:</lable>
                         </div>
                         <div className="col-md-11">
                            <textarea onChange={(e)=>this.handleInput('chineseWord',e)} className="form-control" />
                         </div>
                        </div>
                        <div  className="form-group" >
                            <div className="col-md-1 text-right" >
                        <lable className="control-label"> 总结:</lable>
                            </div>
                            <div className="col-md-11">
                            <textarea onChange={(e)=>this.handleInput('xiaobian',e)}  className="form-control" />
                            </div>
                        </div>
                        <div  className="form-group" >
                            <div className="col-md-1 text-right" >
                        <lable className="control-label"> 图片:</lable>
                            </div>
                            <div className="col-md-11">
                            <input type="text" onChange={(e)=>this.handleInput('pic',e)} className="form-control"/>
                            </div>
                        </div>
                        <div  className="form-group" >
                            <div className="col-md-1 text-right" >
                                <lable className="control-label"> 音频:</lable>
                            </div>
                            <div className="col-md-11">
                                <input type="text" onChange={(e)=>this.handleInput('audio',e)} className="form-control"/>
                            </div>
                        </div>
                        <div className="col-md-12 text-center">
                        <input type="submit" value="提交" className="btn btn-default"/>
                        </div>
                    </form>
        );
    }
}
export  default  AddMottos;


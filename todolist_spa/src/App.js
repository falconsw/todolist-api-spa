import React, { Component } from "react";
import axios from "axios";
import TodoList from "./components/TodoList";
import TodoListItems from "./components/TodoListItems";

const currentItem = {
    id: 0,
    title: "",
    status: false,
}

const apiUrl = process.env.REACT_APP_API_URL || "";

class App extends Component {
    inputElement = React.createRef()
    constructor() {
        super()
        console.log("constructor")
        this.state = {
            items: [],
            currentItem: currentItem,
        }
    }
    componentDidMount() {
        axios.get(apiUrl + '/api/todolist')
            .then(res => {
                const items = res.data;
                this.setState({ items });
                console.log("componentDidMount")
            })
    }
    deleteItem = id => {
        const filteredItems = this.state.items.filter(item => {
            return item.id !== id
        })
        axios.delete(apiUrl + `/api/todolist/${id}`)
            .then(res => this.setState({
                items: filteredItems
            }));
    }

    updateItem = id => {

        const items = this.state.items
        const findIndex = items.indexOf(items.find(item => item.id === id))
        const filteredItems = items[findIndex]

        axios.put(apiUrl + `/api/todolist/${id}`, {
            status: !filteredItems.status
        }).then(res => {

            items[findIndex].status = res.data.status

            this.setState({
               items
            })
        });
    }

    handleInput = e => {
        console.log("handleInput")
        const itemText = e.target.value

        const currentItem = {
            title: itemText,
            status: false
        }
        this.setState({
            currentItem,
        })
    }
    addItem = e => {
        console.log("addItem")
        e.preventDefault()
        const newItem = this.state.currentItem
        if (newItem.name !== '') {
            axios.post(apiUrl + '/api/todolist', {
                title: newItem.title,
                status: false,
            })
                .then(res => {
                    newItem.id = res.data.id
                    this.setState({
                        items: [...this.state.items, newItem]
                    });
                    console.log("componentDidMount")
                });
        }
    }
    render() {
        return (
            <div className="App h-screen w-full flex justify-center items-center bg-gray-800">
                    <TodoList
                        addItem={this.addItem}
                        inputElement={this.inputElement}
                        handleInput={this.handleInput}
                        currentItem={this.state.currentItem}
                    />
                    <TodoListItems todoListItems={this.state.items} deleteItem={this.deleteItem} updateItem={this.updateItem} />
                </div>
        )
    }
}

export default App
